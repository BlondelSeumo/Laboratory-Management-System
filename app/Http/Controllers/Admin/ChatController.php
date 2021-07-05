<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $users=User::where('id','!=',auth()->guard('admin')->user()['id'])->get();

        return view('admin.chat.index',compact('users'));
    }
}
