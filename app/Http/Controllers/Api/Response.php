<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class Response extends Controller
{
    public static function validation($request,$rules)
    {
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
    
            return response()->json(
                [
                    'code'=>400,
                    'message'=>$validator->errors(),
                    'body'=>''
                ]
            );
        }
    }

    public static function response($code,$message,$body)
    {
        return response()->json([
            'code'=>$code,
            'message'=>$message,
            'body'=>$body
        ]);
    }
}
