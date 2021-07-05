<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Culture;
use App\Http\Controllers\Api\Response;

class TestsLibraryController extends Controller
{
    public function tests()
    {
        $tests=Test::select('name','shortcut','sample_type','precautions')->where('parent_id',0)->orWhere('separated',true)->paginate(10);

        return Response::response(200,'success',['tests'=>$tests]);
    }

    public function cultures()
    {
        $cultures=Culture::select('name','sample_type','precautions')->paginate(10);

        return Response::response(200,'success',['culutres'=>$cultures]);
    }
}
