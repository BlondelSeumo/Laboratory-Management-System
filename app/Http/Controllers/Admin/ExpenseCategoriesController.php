<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Requests\Admin\ExpenseCategoryRequest;
use DataTables;

class ExpenseCategoriesController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_expense_category',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_expense_category',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_expense_category',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_expense_category',   ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounting.expense_categories.index');
    }

    /**
    * get analyses datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=ExpenseCategory::query();

        return DataTables::eloquent($model)
        ->addColumn('action',function($expense_category){
            return view('admin.accounting.expense_categories._action',compact('expense_category'));
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
        return view('admin.accounting.expense_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseCategoryRequest $request)
    {
        ExpenseCategory::create($request->except('_token'));

        session()->flash('success',__('Expense category created successfully'));

        return redirect()->route('admin.expense_categories.index'); 
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
        $expense_category=ExpenseCategory::findOrFail($id);

        return view('admin.accounting.expense_categories.edit',compact('expense_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategoryRequest $request, $id)
    {
        $expense_category=ExpenseCategory::findOrFail($id);
        $expense_category->update($request->except('_token','_method'));

        session()->flash('success',__('Expense category updated successfully'));

        return redirect()->route('admin.expense_categories.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense_category=ExpenseCategory::findOrFail($id);
        $expense_category->delete();

        session()->flash('success',__('Expense category deleted successfully'));

        return redirect()->route('admin.expense_categories.index'); 
    }
}
