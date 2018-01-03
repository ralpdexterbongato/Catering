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
class RequestController extends Controller
{
    public function show($companyid)
    {
      $company = array('id' =>$companyid);
      $company= json_encode($company);
      $location=CompanyMap::where('company_id', $companyid)->get();
      $customPack=Session::get('company'.$companyid);
      $customPack = json_encode($customPack);
      $colorChoices=CompanyColor::where('company_id',$companyid)->get(['id','hex']);
      $companyMinimum=company::where('id', $companyid)->get(['minimum']);
      return view('Request.ProceedForm',compact('customPack','companyMinimum','company','location','colorChoices'));
    }
    public function sendRequest(Request $request,$companyId)
    {
      $this->validate($request,[
        'message'=>'max:191',
        'eventName'=>'required|max:30',
        'visitor'=>'required|numeric|max:9999|min:'.$request->minimum,
        'dateStart'=>'required',
        'timeStart'=>'required',
        'contact'=>'required',
        'lat'=>'required',
        'lng'=>'required'
      ]);

      $dbdate=date( 'Y-m-d', strtotime( $request->dateStart ) );

      $orderDB = new order;
      $orderDB->user_id= Auth::user()->id;
      $orderDB->company_id=$companyId;
      $orderDB->message=$request->message;
      $orderDB->event_name=$request->eventName;
      $orderDB->expectedVisitors=$request->visitor;
      $orderDB->date_start=$dbdate;
      $orderDB->time_start = $request->timeStart;
      $orderDB->client_contact = $request->contact;
      $orderDB->address_lat = $request->lat;
      $orderDB->address_lng = $request->lng;
      $orderDB->save();

      $forOrderDetail = array();
      foreach (Session::get('company'.$companyId) as $key => $product)
      {
        $forOrderDetail[] = array('product_id' => $product->foodId,'order_id'=>$orderDB->id);
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
      product_order::insert($forOrderDetail);
      Session::forget('company'.$companyId);
      return ['redirect'=>'/company-show/'.$companyId];
    }
    public function showRequestList()
    {
      return view('Request.AcceptOrDeclinePage');
    }
    public function fetchRequest()
    {
      $companyId = company::where('user_id', Auth::user()->id)->value('id');
      return order::whereNull('status')->where('company_id', $companyId)->with('user')->orderBy('id','ASC')->paginate(12,['id','user_id','client_contact','created_at']);
    }
    public function fetchRequestData($orderId)
    {
       $OneOrderData=order::where('id', $orderId)->with('colors')->with('products')->get();
       $ExistingOrderSameDate=order::where('status','0')->with('user')->where('date_start',$OneOrderData[0]->date_start)->get(['id','user_id','event_name','address_lat','message','address_lng','time_start']);
       $response = array('OrderData' =>$OneOrderData, 'existing'=>$ExistingOrderSameDate);
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
}
