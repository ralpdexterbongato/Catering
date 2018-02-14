<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use Auth;
use Carbon\Carbon;
use Image;
use App\User;
use App\CompanyMap;
class companycontroller extends Controller
{
    public function Index()
    {
      return view('Company.CompanyIndex');
    }
    public function indexData()
    {
      return $companies=company::orderBy('created_at')->paginate(9);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'max:30|required|min:2',
        'description'=>'required|max:191',
        'lat'=>'required',
        'lng'=>'required'
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

      $companyMapDB = new CompanyMap;
      $companyMapDB->company_id=$companyTbl->id;
      $companyMapDB->lat = $request->lat;
      $companyMapDB->lng= $request->lng;
      $companyMapDB->save();

      User::where('id',Auth::user()->id)->update(['role'=>'1']);
      return ['redirect'=>'/company-show/'.$companyTbl->id];
    }
    public function show($id)
    {
      $CompanyData = ['id'=>$id];
      $CompanyData = json_encode($CompanyData);
      $mapdata=CompanyMap::where('company_id', $id)->get();
      return view('Company.CompanyProfile',compact('CompanyData','mapdata'));
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
