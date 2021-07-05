<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Culture;
use App\Models\Patient;
use App\Models\Antibiotic;
use App\Models\Group;
use App\Models\GroupTest;
use App\Models\GroupCulture;
use App\Models\Visit;
use App\Models\Expense;
use App\Models\Contract;
use Spatie\Activitylog\Models\Activity;

class IndexController extends Controller
{
    /**
     * admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //general statistics
        $tests_count=Test::where('parent_id',0)->orWhere('separated',true)->count();
        $cultures_count=Culture::count();
        $antibiotics_count=Antibiotic::count();
        $patients_count=Patient::count();
        $contracts_count=Contract::count();
        $visits_count=Visit::count();
       
        //tests statistics
        $group_tests_count=GroupTest::count();
        $pending_tests_count=GroupTest::where('done',false)->count();
        $done_tests_count=GroupTest::where('done',true)->count();

        //cultures statistics
        $group_cultures_count=GroupCulture::count();
        $pending_cultures_count=GroupCulture::where('done',false)->count();
        $done_cultures_count=GroupCulture::where('done',true)->count();

        //new home visists
        $visits=Visit::with('patient')->where('read',false)->get();

        //todays visits
        $today_visits=Visit::with('patient')->where('visit_date','like','%'.date('d-m-Y').'%')->get();
       
        //total income , due , payment
        $today_paid=0;

        $today_groups=Group::whereDate('created_at',now())->get();

        foreach($today_groups as $group)
        {
            $today_paid+=$group['paid'];
        }

        //expenses
        $today_total_expense=0;
        
        $today_expenses=Expense::whereDate('date',now())->get();
       
        foreach($today_expenses as $today_expense)
        {
            $today_total_expense+=$today_expense['amount'];
        }

        //today profit
        $today_profit=$today_paid-$today_total_expense;
        

        return view('admin.index',compact(
            'tests_count',
            'cultures_count',
            'antibiotics_count',
            'patients_count',
            'group_tests_count',
            'pending_tests_count',
            'done_tests_count',
            'group_cultures_count',
            'pending_cultures_count',
            'done_cultures_count',
            'visits',
            'today_visits',
            'today_paid',
            'today_total_expense',
            'today_profit',
            'contracts_count',
            'visits_count'
        ));
    }
}
