<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\food;
class OrderSessionController extends Controller
{
    public function store(Request $request,$companyid)
    {
      $orders=Session::get('company'.$companyid);
      if (!empty($orders))
      {
        foreach ($orders as $key => $order)
        {
          if (($order->foodId==$request->FoodId))
          {
            return ['error'=>'This food is already added'];
          }
        }
      }
      $newfoodtoadd = array('foodId' =>$request->FoodId,'foodImage'=>$request->FoodImage,'foodName'=>$request->FoodName);
      $newfoodtoadd = (object)$newfoodtoadd;
      Session::push('company'.$companyid,$newfoodtoadd);

    }
    public function show($companyid)
    {
       $foodsaved = Session::get('company'.$companyid);
       if ($foodsaved!=null)
       {
         $foodsaved=array_reverse($foodsaved);
         $response = array('foodsaved'=>$foodsaved);

         return response()->json($response);
       }
    }
    public function delete($companyid,$foodid)
    {
      $foodsaved=Session::get('company'.$companyid);
      foreach ($foodsaved as $key => $food)
      {
        if ($food->foodId == $foodid)
        {
          unset($foodsaved[$key]);
        }
      }
      Session::put('company'.$companyid,$foodsaved);
      return ['success'=>'success'];
    }
}
