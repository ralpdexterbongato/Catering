<?php

namespace App\Http\Controllers;
use App\food;
use App\price;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\Category;
use App\category_food;
class foodcontroller extends Controller
{
    public function Index()
    {
      return view('Food.FoodIndex');
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:25',
        'FoodImage'=>'required',
        'description'=>'required',
        'categories.*'=>'required'
      ]);
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

          $date=Carbon::now();
          $forFoodCatTable = array();
          foreach ($request->categories as $key => $category)
          {
            $forFoodCatTable[] = array('food_id' =>$foodTbl->id ,'category_id'=>$category,'created_at'=>$date);
          }
          category_food::insert($forFoodCatTable);
      }
      return ['success'=>'success'];
    }
    public function displaycompanyfood($companyId)
    {
      return food::orderBy('id','DESC')->where('company_id', $companyId)->paginate(6);
    }
    public function fetchCategories()
    {
      return Category::all();
    }
}
