<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\company;
use App\order;
use App\package;
class ScheduleController extends Controller
{
    public function show()
    {
      return view('Request.Calendar');
    }
    public function showCurrentMonthEvents()
    {
      $YMNow=Carbon::now()->format('Y-m');
      if (Auth::user()->role==1)
      {
        $companyOwnedId=company::where('user_id', Auth::user()->id)->value('id');
        return order::orderBy('time_start')->where('company_id',$companyOwnedId)->with('user')->with('products')->with('colors')->where('status', '0')->where('date_start','LIKE',$YMNow.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message','package_id']);
      }
      if (Auth::user()->role==0) {
        return order::orderBy('time_start')->where('user_id',Auth::user()->id)->with('user')->with('products')->with('colors')->where('status', '0')->where('date_start','LIKE',$YMNow.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message','package_id']);
      }
    }
    public function showMonthSelectedEvents(Request $request)
    {
      $request->month;
      $date_parts = explode('/', $request->month);
      $formatedDateMonth=$this->attributes['start_date'] = $date_parts[1].'-'.$date_parts[0];
      if (Auth::user()->role==1)
      {
        $companyOwnedId=company::where('user_id', Auth::user()->id)->value('id');
        return order::orderBy('time_start')->where('company_id',$companyOwnedId)->with('user')->with('products')->with('colors')->where('status', '0')->where('date_start','LIKE',$formatedDateMonth.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message','package_id']);
      }
      if (Auth::user()->role==0) {
        return order::orderBy('time_start')->where('user_id',Auth::user()->id)->with('user')->with('products')->with('colors')->where('status', '0')->where('date_start','LIKE',$formatedDateMonth.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message','package_id']);
      }
    }
    public function fetchPackage($id)
    {
      return package::where('id', $id)->with('products')->get();
    }
}
