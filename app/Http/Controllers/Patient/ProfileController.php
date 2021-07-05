<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\Patient\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $patient=Patient::findOrFail(auth()->guard('patient')->user()['id']);
        return view('patient.profile.edit',compact('patient'));
    }

    public function update(ProfileRequest $request)
    {
        Patient::where('id',auth()->guard('patient')->user()['id'])
                ->update($request->except('_token'));
        
        session()->flash('success',__('Profile updated successfully'));

        return redirect()->back();
    }
}
