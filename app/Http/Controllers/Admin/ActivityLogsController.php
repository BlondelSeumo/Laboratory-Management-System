<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use DataTables;

class ActivityLogsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_activity_log',     ['only' => ['index','ajax']]);
        $this->middleware('can:clear_activity_log',     ['only' => ['clear']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.activity_logs.index',compact('users'));
    }

     /**
     * datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        $model=Activity::with('causer')->orderBy('id','desc');

        if(!empty($request['filter_user']))
        {
            $model->where('causer_id',$request['filter_user']);
        }

        return DataTables::eloquent($model)
        ->editColumn('created_at',function($activity){
            return view('admin.activity_logs._created_at',compact('activity'));
        })
        ->addColumn('causer',function($activity){
            return view('admin.activity_logs._causer',compact('activity'));
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * clear activity logs
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        Activity::truncate();

        session()->flash('success',__('Activity log cleared successfully'));

        return redirect()->route('admin.activity_logs.index');
    }
}
