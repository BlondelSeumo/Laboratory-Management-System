<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Requests\Admin\BranchRequest;
use DataTables;

class BranchesController extends Controller
{
     /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_branch',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_branch',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_branch',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_branch',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.branches.index');
    }

    /**
    * get branches datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Branch::query();

        return DataTables::eloquent($model)
        ->addColumn('action',function($branch){
            return view('admin.branches._action',compact('branch'));
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
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        Branch::create($request->except('_token','_method'));

        session()->flash('success',__('Branch created successfully'));

        return redirect()->route('admin.branches.index');
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
        $branch=Branch::find($id);

        return view('admin.branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        $branch=Branch::findOrFail($id);
        $branch->update($request->except('_token','_method'));
        
        session()->flash('success',__('Branch updated successfully'));

        return redirect()->route('admin.branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch=Branch::findOrFail($id);
        $branch->delete();

        session()->flash('success',__('Branch deleted successfully'));

        return redirect()->route('admin.branches.index');
    }
}
