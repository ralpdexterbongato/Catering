<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function create()
    {
      return view('Package.Create');
    }
}
