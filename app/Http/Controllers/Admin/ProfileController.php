<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Show the form for editing profile
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.profile.edit');
    }

    /**
     * Update profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        //update user
        $user=User::findOrFail(auth()->guard('admin')->user()->id);
        $user->name=$request->name;
        $user->email=$request->email;
    
        //optional updating password
        if(!empty($request['password']))
        {
            $user->password=bcrypt($request->password);
        }

        //signature
        if($request->hasFile('signature'))
        {
            //upload signature
            $signature=$request->file('signature');
            $signature_name=auth()->guard('admin')->user()->id.'.'.$signature->getClientOriginalExtension();
            $signature->move('uploads/signature',$signature_name);
            $user->signature=$signature_name;
        }
        
        $user->save();

        session()->flash('success',__('Profile updated successfully'));

        return redirect()->route('admin.profile.edit');
        
    }    
}
