<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class usercontroller extends Controller
{
  public function loginSubmit(Request $request)
  {
    $this->validate($request,[
      'username'=>'required',
      'password'=>'required'
    ]);
    $credentials =['username'=>$request->username,'password'=>$request->password];
    if (Auth::attempt($credentials))
    {
      return;
    }else
    {
      return ['error'=>'Incorrect username or password'];
    }
  }
  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }
  public function accountConfirmation()
  {
    
  }
}
