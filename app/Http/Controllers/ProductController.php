<?php

namespace App\Http\Controllers;
use App\Product;
use App\price;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\company;
use Auth;
class ProductController extends Controller
{
    public function Index()
    {
      $popularFoods=Product::where('Available', '0')->orderBy('RequestCount','DESC')->paginate(12);
      return view('Product.FoodIndex',compact('popularFoods'));
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:25',
        'FoodImage'=>'required',
        'description'=>'required|max:190',
        'type'=>'required',
        'price'=> 'required|min:1',
      ]);
      if ($request->FoodImage!=null)
      {
          $imageData = $request->get('FoodImage');
          $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
          Image::make($request->get('FoodImage'))->save(public_path('/storage/images/').$fileName);

          $productTbl= new Product;
          $productTbl->name = $request->name;
          $productTbl->image= $fileName;
          $productTbl->price = $request->price;
          $productTbl->description= $request->description;
          $productTbl->company_id = $request->companyid;
          $productTbl->Type = $request->type;
          $productTbl->save();
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
      $ownerId=company::where('id', $companyId)->value('user_id');
      if (Auth::check() && $ownerId==Auth::user()->id)
      {
        return Product::orderBy('id','DESC')->where('company_id', $companyId)->where('Type',$type)->where('name','LIKE','%'.$request->search.'%')->paginate(6);
      }else
      {
        return Product::orderBy('id','DESC')->where('Available','0')->where('company_id', $companyId)->where('Type',$type)->where('name','LIKE','%'.$request->search.'%')->paginate(6);
      }

    }
    public function delete($productId)
    {
      Product::where('id',$productId)->delete();
      return ['success'=>'success'];
    }
    public function fetchEditDetail($productId)
    {
      return Product::where('id', $productId)->get();
    }
    public function update(Request $request,$productId)
    {
      $this->validate($request,[
        'name'=>'required|max:25',
        'description'=>'required|max:190',
        'type'=>'required',
        'price'=>'required|min:1'
      ]);

      if ($request->image!=null)
      {
        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('/storage/images/').$fileName);
        Product::where('id',$productId)->update(['name'=>$request->name,'image'=>$fileName,'description'=>$request->description,'Type'=>$request->type]);
      }else
      {
        Product::where('id',$productId)->update(['name'=>$request->name,'description'=>$request->description,'Type'=>$request->type,'price'=>$request->price]);
      }
      return ['success'=>'success'];
    }
    public function toggleAvailable($productId)
    {
      $available=Product::where('id', $productId)->value('available');
      if ($available==0)
      {
        Product::where('id', $productId)->update(['available'=>1]);
      }
      if ($available==1)
      {
        Product::where('id', $productId)->update(['available'=>0]);
      }
    }
}
