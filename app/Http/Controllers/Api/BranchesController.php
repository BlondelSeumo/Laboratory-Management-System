<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Controllers\Api\Response;

class BranchesController extends Controller
{
    public function index()
    {
        $branches=Branch::all();
        
        return Response::response(200,'success',[
           'braches'=>$branches
        ]);
    }
}
