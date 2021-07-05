<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\ResetMailRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use App\Models\Setting;
use App\Mail\ResetPassword;
use Hash;
use Auth;
use Mail;
use Str;
class AdminController extends Controller
{
    /**
    * show login form
    *
    * @access public
    */
    public function login()
    {
        $info=setting('info');

        return view('auth.admin.login',compact('info'));
    }

    /**
    * submit login form
    * @request $request
    * @access public
    */
    public function login_submit(LoginRequest $request)
    {
        //logout from patient
        auth()->guard('patient')->logout();
        
        $user=User::where('email',$request['email'])->first();
        //check if email exist
        if(isset($user)&&Hash::check($request['password'],$user['password']))
        {
            $remember=($request->has('remeber'))?true:false;

            Auth::guard('admin')->login($user,$remember);

            Auth::shouldUse('admin');

            return redirect('admin');
        }
        else{
            session()->flash('failed',__('Wrong email or password'));
            return redirect()->route('admin.auth.login');
        }
    }

    /**
    * logout admin
    * @request $request
    * @access public
    */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }


    /**
    * 
    * show ressetting mail form
    * @access public
    */
    public function mail()
    {
        $info=setting('info');

        return view('auth.admin.mail',compact('info'));
    }

    /**
    * 
    * sending resetting mail
    * @access public
    */
    public function mail_submit(ResetMailRequest $request)
    {
        $user=User::where('email',$request['email'])->first();

        if(isset($user))
        {
          //generate new user token
          $user->token=Str::random(32);
          $user->save();

          //send mail
          try{
            Mail::to($user['email'])->send(new ResetPassword($user));
            session()->flash('success',__('Please check your email to complete resetting your password'));
          }
          catch(\Exception $e)
          {
            session()->flash('failed',__('Something went wrong'));
          }

          return redirect()->route('admin.reset.mail');
          
        }
        else{

            session()->flash('failed',__('Email not found'));
            return redirect()->route('admin.reset.mail');

        }
    }

    /**
    * 
    * show resetting password form
    * @access public
    */
    public function reset_password_form($token)
    {
        $user=User::where('token',$token)->first();
        
        if(isset($user))
        {
            session()->put('token',$token);

            $info=Setting::where('key','info')->first();

            $info=json_decode($info['value'],true);

            return view('auth.admin.reset_password',compact('info'));
        }
        else{
            return abort(403);
        }
    }

    /**
    * 
    * resetting password
    * @access public
    */
    public function reset_password_submit(ResetPasswordRequest $request)
    {
        $user=User::where('token',session('token'))->first();

        //update user password
        $user->password=bcrypt($request['password']);

        //regenerate token
        $user->token=Str::random(32);
        $user->save();

        session()->flash('success',__('Password reset successfully'));

        return redirect()->route('admin.auth.login');
    }
}
