<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use Auth;
use App\CompanyColor;
use Image;
use Carbon\Carbon;
use App\CompanyMap;
class CompanySettingController extends Controller
{
    public function show()
    {
      $companyId=company::where('user_id', Auth::user()->id)->value('id');
      $companylocation=CompanyMap::where('company_id',$companyId)->get();
      return view('Company.Settings',compact('companylocation'));
    }
    public function showProfile()
    {
      return company::where('user_id', Auth::user()->id)->get(['logo']);
    }
    public function showCover()
    {
      return company::where('user_id', Auth::user()->id)->get(['heroPicture']);
    }
    public function showMinimumVisitor()
    {
      return company::where('user_id', Auth::user()->id)->get(['minimum']);
    }
    public function showColors()
    {
      $companyId =  company::where('user_id', Auth::user()->id)->value('id');
      return CompanyColor::orderBy('id','DESC')->where('company_id', $companyId)->get(['hex','id']);
    }
    public function showName()
    {
      return company::where('user_id', Auth::user()->id)->get(['name']);
    }
    public function showDescription()
    {
      return company::where('user_id', Auth::user()->id)->get(['description']);
    }
    public function updateName(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:35'
      ]);
      company::where('user_id', Auth::user()->id)->update(['name'=>$request->name]);
    }
    public function updateDescription(Request $request)
    {
      $this->validate($request,[
        'description'=>'required|max:180',
      ]);
      company::where('user_id', Auth::user()->id)->update(['description'=>$request->description]);
    }
    public function updateMinimum(Request $request)
    {
      $this->validate($request,[
        'minimum'=>'required|numeric|max:9999'
      ]);
      company::where('user_id', Auth::user()->id)->update(['minimum'=>$request->minimum]);
    }
    public function updateLogo(Request $request)
    {
      $this->validate($request,[
        'Logo'=>'required'
      ]);
      if ($request->Logo!=null)
      {
        $imageData = $request->get('Logo');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('Logo'))->save(public_path('/storage/images/').$fileName);
        company::where('user_id', Auth::user()->id)->update(['logo'=>$fileName]);
      }
      return ['success'=>'success'];
    }
    public function updateCover(Request $request)
    {
      $this->validate($request,[
        'Cover'=>'required'
      ]);
      if ($request->Cover!=null)
      {
        $imageData = $request->get('Cover');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('Cover'))->save(public_path('/storage/images/').$fileName);
        company::where('user_id', Auth::user()->id)->update(['heroPicture'=>$fileName]);
      }
      return ['success'=>'success'];
    }
    public function addColor(Request $request)
    {
      $this->validate($request,[
        'color'=>'required'
      ]);
      $companyId=company::where('user_id', Auth::user()->id)->value('id');
      $colorDB = new CompanyColor;
      $colorDB->company_id = $companyId;
      $colorDB->hex= $request->color;
      $colorDB->save();
      return ['success'=>'success'];
    }
    public function removeColor($id)
    {
      $companyId=company::where('user_id', Auth::user()->id)->value('id');
      CompanyColor::where('company_id', $companyId)->where('id', $id)->delete();
    }
    public function updateMap(Request $request)
    {
      $companyId=company::where('user_id', Auth::user()->id)->value('id');
      $companylocation=CompanyMap::where('company_id',$companyId)->update(['lat'=>$request->lat,'lng'=>$request->lng]);
    }
}
