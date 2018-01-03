<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class OrderDrinkSessionController extends Controller
{
    public function store(Request $request,$companyid)
    {
      $orders=Session::get('CompanyDrink'.$companyid);
      if (!empty($orders))
      {
        foreach ($orders as $key => $order)
        {
          if (($order->drinkId==$request->DrinkId))
          {
            return ['error'=>'This drink is already added'];
          }
        }
      }
      $newDrinktoadd = array('drinkId' =>$request->DrinkId,'drinkImage'=>$request->DrinkImage,'drinkName'=>$request->DrinkName);
      $newDrinktoadd = (object)$newDrinktoadd;
      Session::push('CompanyDrink'.$companyid,$newDrinktoadd);
      return ['success'=>'success'];
    }
    public function show($companyid)
    {
       $Drinks=Session::get('CompanyDrink'.$companyid);
       if (isset($Drinks[0]))
       {
         $Drinks = array_reverse($Drinks);
       }
       return $Drinks;
    }
    public function delete($companyid,$drinkid)
    {
      $drinksaved=Session::get('CompanyDrink'.$companyid);
      foreach ($drinksaved as $key => $drink)
      {
        if ($drink->drinkId == $drinkid)
        {
          unset($drinksaved[$key]);
        }
      }
      Session::put('CompanyDrink'.$companyid,$drinksaved);
      return ['success'=>'success'];
    }
}
