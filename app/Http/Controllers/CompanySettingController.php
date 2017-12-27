<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use Auth;
class CompanySettingController extends Controller
{
    public function show()
    {
      return view('Company.Settings');
    }
    public function showProfile()
    {
      return company::where('user_id', Auth::user()->id)->get(['logo']);
    }
    public function showCover()
    {
      return company::where('user_id', Auth::user()->id)->get(['heroPicture']);
    }
}
