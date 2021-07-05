<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Http\Requests\Admin\ContractRequest;
use DataTables;

class ContractsController extends Controller
{
    
     /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_contract',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_contract',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_contract',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_contract',   ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contracts.index');
    }

    /**
    * get antibiotics datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Contract::query();

        return DataTables::eloquent($model)
        ->editColumn('discount',function($contract){
            return $contract['discount'].' %';
        })
        ->addColumn('action',function($contract){
            return view('admin.contracts._action',compact('contract'));
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
        return view('admin.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
       Contract::create($request->except('_token','_method','files'));

       session()->flash('success',__('Contract created successfully'));

       return redirect()->route('admin.contracts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract=Contract::findOrFail($id);

        return view('admin.contracts.edit',compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
       $contract=Contract::findOrFail($id);
       $contract->update($request->except('_token','_method','files'));

       session()->flash('success',__('Contract updated successfully'));

       return redirect()->route('admin.contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract=Contract::findOrFail($contract);
        $contract->delete();

        session()->flash('success',__('Contract deleted successfully'));

        return redirect()->route('admin.contracts.index');
    }
}
