<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;
use App\Product;
use App\company;
use App\ProductPackage;
use Auth;
class PackageController extends Controller
{
    public function create()
    {
      return view('Package.Create');
    }
    public function showallproduct(Request $request)
    {
      $companyid=company::where('user_id', Auth::user()->id)->value('id');
      return Product::where('company_id', $companyid)->where('name','LIKE','%'.$request->search.'%')->paginate(10);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required',
        'descript'=>'required',
        'price'=>'required',
      ]);
      if (empty($request->products[0]))
      {
        return ['error'=>'Please choose from your products'];
      }
      $companyid=company::where('user_id', Auth::user()->id)->value('id');

      $packageTbl = new package;
      $packageTbl->company_id=$companyid;
      $packageTbl->price = $request->price;
      $packageTbl->name = $request->name;
      $packageTbl->description = $request->descript;
      $packageTbl->save();

      $forProdPackages = array();
      foreach ($request->products as $key => $product)
      {
        $product=(object)$product;
        $forProdPackages[] = array('product_id' =>$product->id,'package_id'=>$packageTbl->id);
      }
      ProductPackage::insert($forProdPackages);
      return ['success'=>'Package is successfully created'];
    }
    public function showAllPackageOnProfile($companyid)
    {
      return package::where('company_id',$companyid)->paginate(6);
    }
    public function show($packageid)
    {
      $package = array('id' =>$packageid);
      $package=json_encode($package);
      return view('Package.Show',compact('package'));
    }
    public function showData($packageid)
    {
      return package::where('id', $packageid)->with('company')->with('products')->get();
    }
}
