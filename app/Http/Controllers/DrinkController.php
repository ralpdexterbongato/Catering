<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use Carbon\Carbon;
use Image;
class DrinkController extends Controller
{
    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=>'required|max:25',
        'DrinkImage'=>'required',
        'description'=>'required'
      ]);

      $imageData = $request->get('DrinkImage');
      $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
      Image::make($request->get('DrinkImage'))->save(public_path('/storage/images/').$fileName);
      $DrinkTbl= new Drink;
      $DrinkTbl->name = $request->name;
      $DrinkTbl->image= $fileName;
      $DrinkTbl->description= $request->description;
      $DrinkTbl->company_id = $request->companyid;
      $DrinkTbl->save();

      return ['success'=>'success'];
    }
    public function displayCompanyDrinks($companyId)
    {
      return Drink::orderBy('id','DESC')->where('company_id', $companyId)->paginate(3);
    }
}
