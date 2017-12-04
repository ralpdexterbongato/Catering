<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
class registercontroller extends Controller
{
    public function create()
    {
      return view('Register.RegisterPage');
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'FullName'=>'required',
        'Email'=>'required',
        'UserName'=>'required',
        'password'=>'required|confirmed'
      ]);
      $userTbl=new User;
      $userTbl->name=$request->FullName;
      $userTbl->email=$request->Email;
      $userTbl->username=$request->UserName;
      $userTbl->password=bcrypt($request->password);
      $userTbl->save();

      $credentials = array('username'=>$request->UserName,'password'=>$request->password);
      if (Auth::attempt($credentials))
      {
        return ['redirect'=>'/'];
      }else
      {
        return ['error'=>'Sorry something unexpected happened.'];
      }
    }

}
