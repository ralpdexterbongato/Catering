<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\CompanyMap;
use App\CompanyColor;
use App\order;
use App\product_order;
use App\OrderColor;
use Auth;
use App\company;
use Carbon\Carbon;
use App\Product;
use App\package;
use PDF;
class RequestController extends Controller
{
    public function show($companyid)
    {
      if (Session::has('company'.$companyid))
      {
        Session::forget('CompanyPackage'.$companyid);
      }
      $company = array('id' =>$companyid);
      $company= json_encode($company);
      $location=CompanyMap::where('company_id', $companyid)->get();
      $mypack=Session::get('CompanyPackage'.$companyid);
      $mypack=json_encode($mypack);
      $customPack=Session::get('company'.$companyid);
      $total=0;
      if (isset($customPack))
      {
        foreach ($customPack as $custom)
        {
          $total = $total + $custom->foodPrice;
        }
      }
      $customPack = json_encode($customPack);
      $totalPrice = array('total' =>$total);
      $totalPrice = json_encode($totalPrice);
      $colorChoices=CompanyColor::where('company_id',$companyid)->get(['id','hex']);
      $companyRules=company::where('id', $companyid)->get(['minimum','maximum','show_prices']);

      return view('Request.ProceedForm',compact('customPack','companyRules','company','totalPrice','location','mypack','colorChoices'));
    }
    public function sendRequest(Request $request,$companyId)
    {
      $this->validate($request,[
        'message'=>'max:191',
        'eventName'=>'required|max:30',
        'visitor'=>'required|numeric|min:'.$request->minimum.'|max:'.$request->maximum,
        'dateStart'=>'required',
        'timeStart'=>'required',
        'contact'=>'required',
        'lat'=>'required',
        'lng'=>'required',
        'dine'=>'required'
      ]);

      $dbdate=date( 'Y-m-d', strtotime( $request->dateStart ) );
      if ($request->dine!=1)
      {
        $companyMap = CompanyMap::where('company_id',$companyId)->get(['lat','lng']);
      }
      $packageSession=Session::get('CompanyPackage'.$companyId);
      $orderDB = new order;
      $orderDB->user_id= Auth::user()->id;
      $orderDB->company_id=$companyId;
      $orderDB->message=$request->message;
      $orderDB->event_name=$request->eventName;
      $orderDB->expectedVisitors=$request->visitor;
      $orderDB->date_start=$dbdate;
      $orderDB->dine_in = $request->dine;
      if (isset($packageSession))
      {
        $orderDB->package_id=$packageSession->id;
        $orderDB->package_current_price = $packageSession->price;
      }
      $orderDB->time_start = $request->timeStart;
      $orderDB->client_contact = $request->contact;
      if ($request->dine==1)
      {
        $orderDB->address_lat = $request->lat;
        $orderDB->address_lng = $request->lng;
      }else
      {
        $orderDB->address_lat = $companyMap[0]->lat;
        $orderDB->address_lng = $companyMap[0]->lng;
      }
      $orderDB->save();

      if (Session::has('company'.$companyId))
      {
        $forOrderDetail = array();
        foreach (Session::get('company'.$companyId) as $key => $product)
        {
          $forOrderDetail[] = array('product_id' => $product->foodId,'order_id'=>$orderDB->id,'current_price'=>$product->foodPrice);
        }
        product_order::insert($forOrderDetail);
      }
      if (isset($request->colors))
      {
        $forOrderColor = array();
        foreach ($request->colors as $key => $color)
        {
          $forOrderColor[] = array('color_id' =>$color,'order_id'=>$orderDB->id);
        }
        OrderColor::insert($forOrderColor);
      }
      Session::forget('company'.$companyId);
      Session::forget('CompanyPackage'.$companyId);
      return ['redirect'=>'/company-show/'.$companyId];
    }
    public function showRequestList()
    {
      $privacyPrice=company::where('user_id', Auth::user()->id)->get(['show_prices']);
      return view('Request.AcceptOrDeclinePage',compact('privacyPrice'));
    }
    public function fetchRequest()
    {
      $companyId = company::where('user_id', Auth::user()->id)->value('id');
      return order::whereNull('status')->where('company_id', $companyId)->with('user')->orderBy('id','ASC')->paginate(12,['id','user_id','client_contact','created_at']);
    }
    public function fetchRequestData($orderId)
    {
       $OneOrderData=order::where('id', $orderId)->with('colors')->with('products')->get();
       $packageData=[];
       if ($OneOrderData[0]->package_id!=null)
       {
         $packageData= package::where('id', $OneOrderData[0]->package_id)->with('products')->get();
       }
       $ExistingOrderSameDate=order::where('status','0')->with('user')->where('date_start',$OneOrderData[0]->date_start)->get(['id','user_id','event_name','address_lat','message','address_lng','time_start']);
       $response = array('OrderData' =>$OneOrderData, 'existing'=>$ExistingOrderSameDate ,'PackageData'=>$packageData);
       return response()->json($response);
    }
    public function acceptRequest($orderId)
    {
      order::where('id', $orderId)->update(['status'=>'0','notification_time'=>Carbon::now()]);
      $ProductRequested=order::where('id', $orderId)->with('products')->get(['id']);
      foreach ($ProductRequested as $key => $requested)
      {
        foreach ($requested->products as $product) {
          Product::where('id', $product->id)->increment('RequestCount');
        }
      }
      return ['success'=>'success'];
    }
    public function declineRequest($orderId)
    {
      order::where('id', $orderId)->update(['status'=>'1','notification_time'=>Carbon::now()]);
      return ['success'=>'success'];
    }
    public function toPDF($id)
    {
      $data=order::where('id', $id)->with('user')->with('products')->with('colors')->with('company')->where('status', '0')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng'
      ,'message','package_id','dine_in','company_id','package_current_price']);
      $packageData = [];
      $total = 0;

      if (empty($data[0]->package_id))
      {
        foreach ($data[0]->products as $key => $product)
        {
          $total = $total + $product->pivot->current_price;
        }
      }else
      {
       $packageData = package::where('id', $data[0]->package_id)->with('products')->get(['id','name','description']);
      }
      $pdf = PDF::loadView('Request.RequestPDF',compact('data','total','packageData'));
		  return $pdf->stream('invoice.pdf');
    }
}
