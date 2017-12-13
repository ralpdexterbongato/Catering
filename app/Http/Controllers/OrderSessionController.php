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
      $duplicated=false;
      if (!empty($orders))
      {
        foreach ($orders as $key => $order)
        {
          if ($order->foodId==$request->FoodId)
          {
            $order->Qty= $order->Qty + $request->Qty;
            $duplicated=true;
          }
        }
      Session::put('company'.$companyid,$orders);
      }

      if ($duplicated==false)
      {
        $newfoodtoadd = array('foodId' =>$request->FoodId,'foodImage'=>$request->FoodImage,'foodName'=>$request->FoodName,'foodPrice'=>$request->Price,'Size'=>$request->Size,'Qty'=>$request->Qty);
        $newfoodtoadd = (object)$newfoodtoadd;
        Session::push('company'.$companyid,$newfoodtoadd);
      }

    }
    public function show($companyid)
    {
       $foodsaved = Session::get('company'.$companyid);
       $total=0;
       if ($foodsaved!=null)
       {
         foreach ($foodsaved as $key => $food)
         {
           $product= $food->foodPrice * $food->Qty;
           $total = $total + $product;
         }
         $foodsaved=array_reverse($foodsaved);
         $response = array('total' => $total,'foodsaved'=>$foodsaved);

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
