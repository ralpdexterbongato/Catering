<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\food;
class OrderSessionController extends Controller
{
    public function store(Request $request,$companyid)
    {
      $newfoodtoadd = array('foodId' =>$request->FoodId,'foodImage'=>$request->FoodImage,'foodName'=>$request->FoodName,'foodPrice'=>$request->Price,'Size'=>$request->Size);
      Session::push('company'.$companyid,$newfoodtoadd);
    }
    public function show($companyid)
    {
       $foodsaved = Session::get('company'.$companyid);
       if ($foodsaved!=null)
       {
        return $foodsaved=array_reverse($foodsaved);
       }
    }
}
