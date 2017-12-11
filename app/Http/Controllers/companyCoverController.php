<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;
use App\company;
class companyCoverController extends Controller
{
    public function update(Request $request,$companyid)
    {
      if ($request->Cover!=null)
      {
        $imageData = $request->get('Cover');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('Cover'))->save(public_path('/storage/images/').$fileName);
        company::where('id', $companyid)->update(['heroPicture'=>$fileName]);
        return ['NewCover'=>$fileName];
      }
    }
}
