<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class companycontroller extends Controller
{
    public function Index()
    {
      return view('Company.CompanyIndex');
    }
}
