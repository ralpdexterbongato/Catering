<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;
use App\Product;
use App\company;
use App\ProductPackage;
use Auth;
use Session;
class PackageController extends Controller
{
    public function create()
    {
      return view('Package.Create');
    }
    public function showallproduct(Request $request)
    {
      $companyid=company::where('user_id', Auth::user()->id)->value('id');
      return Product::where('Available', '0')->where('company_id', $companyid)->where('name','LIKE','%'.$request->search.'%')->paginate(10);
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
      $companyid=package::where('id', $packageid)->value('company_id');
      $ownerid = company::where('id', $companyid)->get(['user_id']);
      return view('Package.Show',compact('package','ownerid'));
    }
    public function showName($packageid)
    {
      return package::where('id', $packageid)->with('company')->get(['id','name','company_id']);
    }
    public function showDescription($packageid)
    {
      return package::where('id', $packageid)->get(['id','description']);
    }
    public function showPrice($packageid)
    {
      return package::where('id', $packageid)->get(['id','price']);
    }
    public function proceed(Request $request)
    {
      Session::forget('company'.$request->companyid);
      $packageData = array('id' =>$request->id,'name'=>$request->name,'description'=>$request->description,'price'=>$request->price);
      $packageData=(object)$packageData;
      Session::put('CompanyPackage'.$request->companyid,$packageData);
      return ['redirect'=>"/request-proceed/$request->companyid"];
    }
    public function updateName(Request $request,$packageId)
    {
      $this->validate($request,[
        'name'=>'required'
      ]);
      package::where('id', $packageId)->update(['name'=>$request->name]);
      return $request->name;
    }
    public function updateDescription(Request $request,$packageId)
    {
      $this->validate($request,[
        'description'=>'required'
      ]);
      package::where('id', $packageId)->update(['description'=>$request->description]);
      return $request->description;
    }
    public function updatePrice(Request $request,$packageId)
    {
      $this->validate($request,[
        'price'=>'required'
      ]);
      package::where('id', $packageId)->update(['price'=>$request->price]);
      return $request->price;
    }
    public function showPackageProducts($packageId)
    {
      return package::where('id',$packageId)->with('products')->get(['id']);
    }
    public function removePackageProduct($packageId,$productId)
    {
      ProductPackage::where('package_id', $packageId)->where('product_id', $productId)->delete();
      return ['success'=>'success'];
    }
    public function storePackageProduct(Request $request,$packageId)
    {
      $this->validate($request,[
        'productId'=>'required'
      ]);
      $ErrorIfNotNull=ProductPackage::where('product_id',$request->productId)->where('package_id', $packageId)->get(['id']);
      if (!empty($ErrorIfNotNull[0]))
      {
        return ['error'=>'Sorry this package already have this product'];
      }
      $ProdPackageDB=new ProductPackage;
      $ProdPackageDB->product_id = $request->productId;
      $ProdPackageDB->package_id= $packageId;
      $ProdPackageDB->save();
      return ['success'=>'success'];
    }
    public function delete($packageId)
    {
      ProductPackage::where('package_id',$packageId)->delete();
      package::where('id', $packageId)->delete();
      return ['redirect'=>'/company-show'];
    }
}
