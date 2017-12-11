<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use Carbon\Carbon;
use Image;
class companyProfileController extends Controller
{
    public function update(Request $request,$companyid)
    {
      if ($request->Logo!=null)
      {
        $imageData = $request->get('Logo');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('Logo'))->save(public_path('/storage/images/').$fileName);
      }
      company::where('id',$companyid)->update(['logo'=>$fileName]);
      return;
    }
}
