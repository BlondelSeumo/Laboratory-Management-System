<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupAnalysis;
use App\Models\GroupCulture;
use App\Models\GroupAnalysisResult;
use App\Models\Analysis;
use App\Models\Culture;
use App\Models\GroupCultureResult;

use App\Http\Controllers\Api\Response;

class GroupTestsController extends Controller
{

    public function group_tests(Request $request)
    {
        $groups=Group::where('patient_id',$request->user()->id)->select('id','total','discount','paid','due','created_at','done','report_pdf','receipt_pdf')->get();

        return Response::response(200,'success',['groups'=>$groups]);
    }
}
