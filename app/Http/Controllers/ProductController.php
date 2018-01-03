<?php

namespace App\Http\Controllers;
use App\Product;
use App\price;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\Category;
use App\category_product;
class ProductController extends Controller
{
    public function Index()
    {
      $popularFoods=Product::whereNull('disabled')->orderBy('RequestCount','DESC')->paginate(12);
      return view('Product.FoodIndex',compact('popularFoods'));
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:25',
        'FoodImage'=>'required',
        'description'=>'required',
        'categories.*'=>'required',
        'type'=>'required'
      ]);
      if ($request->FoodImage!=null)
      {
          $imageData = $request->get('FoodImage');
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
          Image::make($request->get('FoodImage'))->save(public_path('/storage/images/').$fileName);

          $productTbl= new Product;
          $productTbl->name = $request->name;
          $productTbl->image= $fileName;
          $productTbl->description= $request->description;
          $productTbl->company_id = $request->companyid;
          $productTbl->Type = $request->type;
          $productTbl->save();

          $date=Carbon::now();
          $forFoodCatTable = array();
          foreach ($request->categories as $key => $category)
          {
            $forFoodCatTable[] = array('food_id' =>$productTbl->id ,'category_id'=>$category,'created_at'=>$date);
          }
          category_product::insert($forFoodCatTable);
      }
      return ['success'=>'success'];
    }
    public function displaycompanyproduct(Request $request,$companyId)
    {
      if ($request->type)
      {
        $type=$request->type;
      }else
      {
        $type=0;
      }
      return Product::orderBy('id','DESC')->where('company_id', $companyId)->where('Type',$type)->where('name','LIKE','%'.$request->search.'%')->paginate(6);
    }
    public function fetchCategories()
    {
      return Category::all();
    }
}
