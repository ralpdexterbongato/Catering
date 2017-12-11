<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use Auth;
use Carbon\Carbon;
use Image;
use App\User;
class companycontroller extends Controller
{
    public function Index()
    {
      return view('Company.CompanyIndex');
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'max:30|min:1'
      ]);
      if ($request->logo!=null)
      {
        $imageData = $request->get('logo');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('logo'))->save(public_path('/storage/images/').$fileName);
      }
      $companyTbl= new company;
      $companyTbl->user_id=Auth::user()->id;
      $companyTbl->name=$request->name;
      $companyTbl->description=$request->description;
      if ($request->logo!=null)
      {
        $companyTbl->logo=$fileName;
      }
      $companyTbl->save();
      User::where('id',Auth::user()->id)->update(['role'=>'1']);
      return ['redirect'=>'/company-show/'.$companyTbl->id];
    }
    public function show($id)
    {
      $CompanyData = ['id'=>$id];
      $CompanyData = json_encode($CompanyData);
      return view('Company.CompanyProfile',compact('CompanyData'));
    }
    public function showData($id)
    {
      return company::find($id);
    }
    public function showOwnCompany()
    {
      $companyId=company::where('user_id', Auth::user()->id)->value('id');
      return redirect('company-show/'.$companyId);
    }
}
