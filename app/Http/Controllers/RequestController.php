<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\CompanyMap;
use App\CompanyColor;
use App\order;
use App\orderdetail;
use App\OrderColor;
use Auth;
use App\company;
class RequestController extends Controller
{
    public function show($companyid)
    {
      $company = array('id' =>$companyid);
      $company= json_encode($company);

      $location=CompanyMap::where('company_id', $companyid)->get();
      $customFoods=Session::get('company'.$companyid);
      $customFoods = json_encode($customFoods);
      $colorChoices=CompanyColor::where('company_id',$companyid)->get(['id','hex']);
      return view('Request.ProceedForm',compact('customFoods','company','location','colorChoices'));
    }
    public function sendRequest(Request $request,$companyId)
    {
      $this->validate($request,[
        'message'=>'max:191',
        'eventName'=>'required|max:30',
        'visitor'=>'required|numeric|max:9999',
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
      foreach (Session::get('company'.$companyId) as $key => $food)
      {
        $forOrderDetail[] = array('food_id' => $food->foodId,'order_id'=>$orderDB->id);
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
      orderdetail::insert($forOrderDetail);
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
      return order::where('company_id', $companyId)->with('user')->orderBy('id','DESC')->paginate(7,['id','user_id','client_contact','created_at']);
    }
    public function fetchRequestData($orderId)
    {
      return order::where('id', $orderId)->with('colors')->with('foods')->get();
    }
}
