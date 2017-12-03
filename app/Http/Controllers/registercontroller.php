<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registercontroller extends Controller
{
    public function store()
    {
      return view('Register.RegisterPage');
    }
}
