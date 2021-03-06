<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use Carbon\Carbon;
use App\Jobs\SendVerificationJob;
use App\Jobs\ForgetPasswordRecovery;
use Storage;
use Image;
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
      return ['success'=>'success'];
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
  public function settingsShow()
  {
    return view('Account.Settings');
  }
  public function getCurrentUser()
  {
    return Auth::user();
  }
  public function updateName(Request $request)
  {
    $this->validate($request,[
      'newName' => 'required|max:50|regex:/^[a-zA-Z]+$/u'
    ]);
    User::where('id', Auth::user()->id)->update(['name'=>$request->newName]);
    return['success'=>'success'];
  }
  public function updateUserName(Request $request)
  {
    $this->validate($request,[
      'username' => 'required|max:50|unique:users',
    ]);
    User::where('id', Auth::user()->id)->update(['username'=>$request->username]);
    return['success'=>'success'];
  }

  public function updateAvatar(Request $request)
  {
    $this->validate($request,[
      'avatar'=>'required'
    ]);
      $imageData = $request->get('avatar');
      $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
      Image::make($request->get('avatar'))->save(public_path('/storage/images/').$fileName);
      User::where('id', Auth::user()->id)->update(['avatar'=>$fileName]);
  }
  public function updatePassword(Request $request)
  {
    $this->validate($request,[
      'password' => 'required|max:50|confirmed',
      'current'=>'required'
    ]);

    if (Hash::check($request->current,Auth::user()->password))
    {
      User::where('id', Auth::user()->id)->update(['password'=>bcrypt($request->password)]);
      return['success'=>'success'];
    }else
    {
      return['error'=>'Your current password is not right'];
    }
  }
  public function resendEmailVerification()
  {
    $job=(new SendVerificationJob(Auth::user()))
    ->delay(Carbon::now()->addSeconds(10));
    dispatch($job);
    return redirect()->back();
  }
  public function updateEmail(Request $request)
  {
    $this->validate($request,[
      'email'=>'required|email',
      'emailConfirm'=>'required|email',
    ]);
    if ($request->email!=$request->emailConfirm)
    {
      return ['error'=>'Your new email did not match'];
    }
    User::where('id', Auth::user()->id)->update(['email'=>$request->email,'verified'=>'1']);
    $job=(new SendVerificationJob(Auth::user()))
    ->delay(Carbon::now()->addSeconds(10));
    dispatch($job);
  }
  public function forgotPass()
  {
    return view('Account.Forgot');
  }
  public function searchByMailUsername(Request $request)
  {
    return User::where('email',$request->search)->orWhere('username',$request->search)->take(1)->get();
  }
  public function sendForgetPassToEmail(Request $request)
  {
    $data = array('confirmCode' =>$request->confirmation ,'email'=>$request->email);
    $data=(object)$data;
    $job=(new ForgetPasswordRecovery($data))
    ->delay(Carbon::now()->addSeconds(10));
    dispatch($job);
  }
  public function checkifValidChange(Request $request)
  {
    $userMatched=User::where('email', $request->email)->where('confirmation_code', $request->confirmation)->get();

    if (isset($userMatched[0]))
    {
      return view('Account.NewPasswordRecovered',compact('userMatched'));
    }else
    {
      return redirect('/');
    }
  }
  public function updateNewRecoveredPassword(Request $request,$userId)
  {
    $this->validate($request,[
      'password'=>'required|confirmed|max:100'
    ]);
    $validcheck=User::where('id', $userId)->where('confirmation_code', $request->code)->get();
    if (empty($validcheck[0]))
    {
      return ['error'=>'This page is already expired'];
    }
    $newCode=str_random(30);
    User::where('id', $userId)->where('confirmation_code', $request->code)->update(['password'=>bcrypt($request->password),'confirmation_code'=>$newCode]);
    return ['success'=>'success'];
  }
}
