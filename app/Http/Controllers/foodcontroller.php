<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class foodcontroller extends Controller
{
    public function Index()
    {
      return view('Food.FoodIndex');
    }
}