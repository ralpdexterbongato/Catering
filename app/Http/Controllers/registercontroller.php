<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
use Carbon\Carbon;
use App\Jobs\SendVerificationJob;
use Image;
class registercontroller extends Controller
{
    public function create()
    {
      return view('Register.RegisterPage');
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'FullName'=>'required|max:50|min:4',
        'Email'=>'required|unique:users|email',
        'UserName'=>'required|unique:users',
        'password'=>'required|confirmed'
      ]);

      if ($request->Avatar!=null)
      {
        $imageData = $request->get('Avatar');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('Avatar'))->save(public_path('/storage/images/').$fileName);
      }
      $confirmation_code = str_random(30);
      $userTbl=new User;
      $userTbl->name=$request->FullName;
      $userTbl->email=$request->Email;
      $userTbl->username=$request->UserName;
      $userTbl->password=bcrypt($request->password);
      $userTbl->confirmation_code=$confirmation_code;
      $userTbl->avatar = $fileName;
      $userTbl->save();

      $userData=User::find($userTbl->id);

      $job=(new SendVerificationJob($userData))
      ->delay(Carbon::now()->addSeconds(10));
      dispatch($job);

      $credentials = array('username'=>$request->UserName,'password'=>$request->password);
      if (Auth::attempt($credentials))
      {
        return ['redirect'=>'/'];
      }else
      {
        return ['error'=>'Sorry something unexpected happened.'];
      }
    }
    public function verfiyDone(Request $request)
    {
      $unverified=User::where('email',$request->email)->where('confirmation_code',$request->verificationCode)->where('verified', '1')->value('id');
      if ($unverified!=null)
      {
        User::where('email',$request->email)->where('confirmation_code',$request->verificationCode)->update(['verified'=>'0']);
        $email = array('mail' =>$request->email);
        $email=(object)$email;
        return view('Email.verified',compact('email'));
      }else
      {
        return redirect('/');
      }
    }
    public function emailview()
    {
      return view('Email.PasswordForgot');
    }

}
