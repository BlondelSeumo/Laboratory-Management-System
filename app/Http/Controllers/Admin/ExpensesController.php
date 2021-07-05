<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Http\Requests\Admin\ExpenseRequest;
use DataTables;

class ExpensesController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_expense',     ['only' => ['index', 'show','ajax']]);
        $this->middleware('can:create_expense',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_expense',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_expense',   ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounting.expenses.index');
    }

    /**
    * get analyses datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Expense::query()->with('category');

        return DataTables::eloquent($model)
        ->editColumn('amount',function($expense){
           return formated_price($expense['amount']);
        })
        ->addColumn('action',function($expense){
            return view('admin.accounting.expenses._action',compact('expense'));
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
        $expense_categories=ExpenseCategory::all();
        return view('admin.accounting.expenses.create',compact('expense_categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $request['date']=\Carbon\Carbon::parse($request['date']);

        $expense=Expense::create($request->except('_token','_method','files'));

        session()->flash('success',__('Expense created successfully'));

        return redirect()->route('admin.expenses.index');
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
        $expense_categories=ExpenseCategory::all();
        $expense=Expense::findOrFail($id);
        return view('admin.accounting.expenses.edit',compact('expense_categories','expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $id)
    {
        $request['date']=\Carbon\Carbon::parse($request['date']);

        $expense=Expense::findOrFail($id);
        $expense->update($request->except('_token','_method','files'));

        session()->flash('success',__('Expense updated successfully'));

        return redirect()->route('admin.expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense=Expense::findOrFail($id);
        $expense->delete();

        session()->flash('success',__('Expense deleted successfully'));

        return redirect()->route('admin.expenses.index');
    }
}
