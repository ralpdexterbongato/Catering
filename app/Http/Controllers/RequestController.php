<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\CompanyMap;
class RequestController extends Controller
{
    public function show($companyid)
    {
      $location=CompanyMap::where('company_id', $companyid)->get();
      $customFoods=Session::get('company'.$companyid);
      $customFoods = json_encode($customFoods);

      return view('Request.ProceedForm',compact('customFoods','location'));
    }
}
