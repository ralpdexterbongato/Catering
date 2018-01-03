<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\company;
use App\order;
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
        return order::orderBy('time_start')->where('company_id',$companyOwnedId)->with('user')->with('foods')->with('drinks')->with('colors')->where('status', '0')->where('date_start','LIKE',$YMNow.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message']);
      }
      if (Auth::user()->role==0) {
        return order::orderBy('time_start')->where('user_id',Auth::user()->id)->with('user')->with('foods')->with('drinks')->with('colors')->where('status', '0')->where('date_start','LIKE',$YMNow.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message']);
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
        return order::orderBy('time_start')->where('company_id',$companyOwnedId)->with('user')->with('foods')->with('drinks')->with('colors')->where('status', '0')->where('date_start','LIKE',$formatedDateMonth.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message']);
      }
      if (Auth::user()->role==0) {
        return order::orderBy('time_start')->where('user_id',Auth::user()->id)->with('user')->with('foods')->with('drinks')->with('colors')->where('status', '0')->where('date_start','LIKE',$formatedDateMonth.'%')->get(['user_id','id','event_name as title','date_start as date','time_start','client_contact','expectedVisitors','address_lat','address_lng','message']);
      }
    }
}
