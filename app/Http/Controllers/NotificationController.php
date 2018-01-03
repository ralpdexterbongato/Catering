<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\company;
use Auth;
class NotificationController extends Controller
{
  public function show()
  {
     if (Auth::user()->role==0)
     {
       $notifs=order::orderBy('notification_time','DESC')->whereNotNull('status')->with('company')->where('user_id', Auth::user()->id)->paginate(7);
       order::where('user_id', Auth::user()->id)->whereNull('Notification_Read')->whereNotNull('status')->update(['Notification_Read'=>'0']);
       return $notifs;
     }
     if (Auth::user()->role==1)
     {
       $companyId=company::where('user_id',Auth::user()->id)->value('id');
       return order::orderBy('id','ASC')->with('user')->where('company_id', $companyId)->whereNull('status')->paginate(7);
     }
  }
  public function countNotif()
  {
    if (Auth::user()->role==0)
    {
      return $NotifCount = order::where('user_id', Auth::user()->id)->whereNull('Notification_Read')->whereNotNull('status')->count();
    }
    if (Auth::user()->role==1)
    {
      $companyId=company::where('user_id',Auth::user()->id)->value('id');
      return order::where('company_id', $companyId)->whereNull('status')->count();
    }
  }
}
