<?php

namespace App\Http\Middleware;

use Closure;
use App\order;
use App\company;
use Auth;
class PrintRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderData=order::where('id',$request->id)->get(['user_id','company_id']);
        $company_owner=company::where('id', $orderData[0]->company_id)->value('user_id');
        if ((Auth::check())&&(($orderData[0]->user_id == Auth::user()->id)||($company_owner == Auth::user()->id)))
        {
          return $next($request);
        }else
        {
          return redirect('/');
        }
    }
}
