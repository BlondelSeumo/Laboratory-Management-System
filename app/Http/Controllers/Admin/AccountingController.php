<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Expense;
use App\Models\Doctor;
use App\Models\Test;
use App\Models\Culture;

class AccountingController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_accounting_reports',     ['only' => ['index']]);
        $this->middleware('can:generate_report_accounting',     ['only' => ['generate_report']]);
    }

   
    /**
     * accounting view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounting.index');
    }

    /**
     * Generate accounting report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate_report(Request $request)
    {
        $request->validate([
            'date'=>'required'
        ]);

        //format date
        $date=explode('-',$request['date']);
        $from=date('Y-m-d',strtotime($date[0]));
        $to=date('Y-m-d 23:59:59',strtotime($date[1]));

        //select groups of date between
        $groups=($from==$to)?Group::with('patient','doctor')->whereDate('created_at',$from):Group::with('patient','doctor')->whereBetween('created_at',[$from,$to]);

        //filter doctors
        $doctors=[];
        if($request->has('doctors'))
        {
            $groups->whereIn('doctor_id',$request['doctors']);

            $doctors=Doctor::whereIn('id',$request['doctors'])->get();

        }

        //filter tests
        $tests=[];
        if($request->has('tests'))
        {
            $groups->whereHas('tests',function($q)use($request){
               return $q->whereIn('test_id',$request['tests']);
            });

            $tests=Test::whereIn('id',$request['tests'])->get();
        }

        //filter cultures
        $cultures=[];
        if($request->has('cultures'))
        {
            $groups->whereHas('cultures',function($q)use($request){
                return $q->whereIn('culture_id',$request['cultures']);
            });

            $cultures=Culture::whereIn('id',$request['cultures'])->get();
        }

        $groups=$groups->get();

        //make accounting
        $total=0; $paid=0; $due=0;

        foreach($groups as $group)
        {
            $total+=$group['total'];
            $paid+=$group['paid'];
            $due+=$group['due'];
        }

        //expenses
        $expenses=($from==$to)?Expense::with('category')->whereDate('date',$from)->get():Expense::with('category')->whereBetween('date',[$from,$to])->get();

        $total_expenses=0;

        foreach($expenses as $expense)
        {
            $total_expenses+=$expense['amount'];
        }

        //profit
        $profit=$total-$total_expenses;

        //old date
        $input_date=$request['date'];

        //generate pdf
        $show_expenses=$request['show_expenses'];
        $show_profit=$request['show_profit'];
        $show_groups=$request['show_groups'];

        $pdf=generate_pdf(compact(
            'from',
            'to',
            'tests',
            'cultures',
            'doctors',
            'input_date',
            'groups',
            'expenses',
            'total',
            'paid',
            'due',
            'total_expenses',
            'profit',
            'show_groups',
            'show_expenses',
            'show_profit'
        ),3);

        return view('admin.accounting.index',compact(
            'from',
            'to',
            'tests',
            'cultures',
            'doctors',
            'input_date',
            'groups',
            'expenses',
            'total',
            'paid',
            'due',
            'total_expenses',
            'profit',
            'pdf'
        ));
    }


    public function doctor_report()
    {
        return view('admin.accounting.doctor_report');
    }

    public function generate_doctor_report(Request $request)
    {
        $request->validate([
            'date'=>'required',
            'doctor_id'=>'required'
        ]);

        //format date
        $date=explode('-',$request['date']);
        $from=date('Y-m-d',strtotime($date[0]));
        $to=date('Y-m-d 23:59:59',strtotime($date[1]));

        //select groups of date between
        $groups=($from==$to)?Group::with('patient','doctor')->whereDate('created_at',$from):Group::with('patient','doctor')->whereBetween('created_at',[$from,$to]);

        //filter doctors
        if($request->has('doctor_id'))
        {
            $groups->where('doctor_id',$request['doctor_id']);

            $doctor=Doctor::find($request['doctor_id']);
        }

        $groups=$groups->get();

        //make accounting
        $total=0; $paid=0; $due=0;

        foreach($groups as $group)
        {
            $total+=$group['doctor_commission'];
        }

        //payments
        $payments=($from==$to)?Expense::with('category')->whereDate('date',$from)->get():Expense::with('category')->whereBetween('date',[$from,$to])->get();

        foreach($payments as $payment)
        {
            $paid+=$payment['amount'];
        }

        $due=$total-$paid;

        //old date
        $input_date=$request['date'];

        //generate pdf
        $show_groups=$request['show_groups'];
        $show_payments=$request['show_payments'];

        $pdf=generate_pdf(compact(
            'from',
            'to',
            'doctor',
            'input_date',
            'groups',
            'payments',
            'total',
            'paid',
            'due',
            'show_groups',
            'show_payments',
        ),4);

        return view('admin.accounting.doctor_report',compact(
            'from',
            'to',
            'doctor',
            'input_date',
            'groups',
            'payments',
            'total',
            'paid',
            'due',
            'pdf'
        ));
    }
}
