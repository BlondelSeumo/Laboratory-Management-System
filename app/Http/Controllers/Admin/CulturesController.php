<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culture;
use App\Http\Requests\Admin\CultureRequest;
use DataTables;

class CulturesController extends Controller
{

    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_culture',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_culture',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_culture',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_culture',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cultures=Culture::all();
        return view('admin.cultures.index',compact('cultures'));
    }

    /**
    * get cultures datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Culture::query();

        return DataTables::eloquent($model)
        ->editColumn('price',function($culture){
            return formated_price($culture['price']);
        })
        ->addColumn('action',function($culture){
            return view('admin.cultures._action',compact('culture'));
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
        return view('admin.cultures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CultureRequest $request)
    {
        Culture::create($request->except('_token'));
        session()->flash('success','Culture saved successfully');
        return redirect()->route('admin.cultures.index');
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
        $culture=Culture::findOrFail($id);
        return view('admin.cultures.edit',compact('culture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CultureRequest $request, $id)
    {
        $culture=Culture::findOrFail($id);
        $culture->update($request->except('_token','_method'));

        session()->flash('success','Culture updated successfully');
        return redirect()->route('admin.cultures.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $culture=Culture::findOrFail($id);
        $culture->delete();

        session()->flash('success','Culture deleted successfully');
        return redirect()->route('admin.cultures.index');
    }
}
