<?php

namespace App\Http\Controllers;
use App\food;
use App\price;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class foodcontroller extends Controller
{
    public function Index()
    {
      return view('Food.FoodIndex');
    }
    public function store(Request $request)
    {
      if ($request->FoodImage!=null)
      {
          $imageData = $request->get('FoodImage');
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
          Image::make($request->get('FoodImage'))->save(public_path('/storage/images/').$fileName);

          $foodTbl= new food;
          $foodTbl->name = $request->name;
          $foodTbl->image= $fileName;
          $foodTbl->description= $request->description;
          $foodTbl->company_id = $request->companyid;
          $foodTbl->save();

          $forPrices = array(
            array('Amount' =>$request->AmountS,'Size'=>'S','food_id'=>$foodTbl->id,'goodfor'=>$request->goodforS),
            array('Amount' =>$request->AmountM,'Size'=>'M','food_id'=>$foodTbl->id,'goodfor'=>$request->goodforM),
            array('Amount' =>$request->AmountL,'Size'=>'L','food_id'=>$foodTbl->id,'goodfor'=>$request->goodforL)
          );
          price::insert($forPrices);
      }
      return ['success'=>'success'];
    }
}
