<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use File;
use Storage;
use App\Models\loan;
use App\Models\loantransaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $loans_released_monthly = array();
         $loan_collections_monthly = array();
         $date = date("Y-m-d");
         $start_date1 = date_format(date_sub(date_create($date),
             date_interval_create_from_date_string('1 years')),
             'Y-m-d');
         $start_date2 = date_format(date_sub(date_create($date),
             date_interval_create_from_date_string('1 years')),
             'Y-m-d');
         $monthly_actual_expected_data = [];
         $monthly_disbursed_loans_data = [];
         $loop_date = date_format(date_sub(date_create($date),
             date_interval_create_from_date_string('1 years')),
             'Y-m-d');
         for ($i = 1; $i < 14; $i++) {
             $d = explode('-', $loop_date);
             $actual = 0;
             $expected = 0;
             $principal = 0;
             $actual = $actual + \App\Models\loantransaction::where('transaction_type',
                     'repayment')->where('reversed', 0)->where('year',
                     $d[0])->where('month',$d[1])->sum('credit');
             foreach (\App\Models\loan::select("loan_schedules.principal", "loan_schedules.interest", "loan_schedules.penalty",
                 "loan_schedules.fees")->whereIn('loans.status',
                 ['disbursed', 'closed', 'written_off'])->join('loan_schedules', 'loans.id', '=',
                 'loan_schedules.loan_id')->where('loan_schedules.deleted_at', NULL)->where('loan_schedules.year',
                 $d[0])->where('loan_schedules.month',
                 $d[1])->get() as $key) {
                 $expected = $expected + $key->interest + $key->penalty + $key->fees + $key->principal;
                 $principal = $principal + $key->principal;
 
             }
             array_push($monthly_actual_expected_data, array(
                 'month' => date_format(date_create($loop_date),
                     'M' . ' ' . $d[0]),
                 'actual' => $actual,
                 'expected' => $expected
             ));
             array_push($monthly_disbursed_loans_data, array(
                 'month' => date_format(date_create($loop_date),
                     'M' . ' ' . $d[0]),
                 'value' => $principal,
             ));
             //add 1 month to start date
             $loop_date = date_format(date_add(date_create($loop_date),
                 date_interval_create_from_date_string('1 months')),
                 'Y-m-d');
         }
         //daily users
         $loan_statuses = [];
         array_push($loan_statuses, array(
             'label' => 'Pending',
             'value' => \App\Models\loan::where('status', 'pending')->count(),
             'color' => "#FF8A65",
             'highlight' => "#FF8A65",
             'link' => url('loan/data?status=pending'),
             'class' => "warning-300",
 
         ));
         array_push($loan_statuses, array(
             'label' => 'approved',
             'value' => \App\Models\loan::where('status', 'approved')->count(),
             'color' => "#64B5F6",
             'highlight' => "#64B5F6",
             'link' => url('loan/data?status=approved'),
             'class' => "primary-300",
 
         ));
 
         array_push($loan_statuses, array(
             'label' => 'Disbursed',
             'value' => \App\Models\Loan::where('status', 'disbursed')->count(),
             'color' => "#1565C0",
             'highlight' => "#1565C0",
             'link' => url('loan/data?status=disbursed'),
             'class' => "primary-800",
 
         ));
         array_push($loan_statuses, array(
             'label' => 'Rescheduled',
             'value' => \App\Models\loan::where('status', 'rescheduled')->count(),
             'color' => "#00ACC1",
             'highlight' => "#00ACC1",
             'link' => url('loan/data?status=rescheduled'),
             'class' => "info-600",
 
         ));
         array_push($loan_statuses, array(
             'label' => 'Written off',
             'value' => \App\Models\loan::where('status', 'written_off')->count(),
             'color' => "#D32F2F",
             'highlight' => "#D32F2F",
             'link' => url('loan/data?status=written_off'),
             'class' => "danger-700",
 
         ));
         array_push($loan_statuses, array(
             'label' => 'Declined',
             'value' => \App\Models\loan::where('status', 'declined')->count(),
             'color' => "#EF5350",
             'highlight' => "#EF5350",
             'link' => url('loan/data?status=declined'),
             'class' => "danger-400",
 
         ));
         array_push($loan_statuses, array(
             'label' => 'closed',
             'value' => \App\Models\loan::where('status', 'closed')->count(),
             'color' => "#66BB6A",
             'highlight' => "#66BB6A",
             'link' => url('loan/data?status=closed'),
             'class' => "success-400",
 
         ));
         $monthly_actual_expected_data = json_encode($monthly_actual_expected_data);
         $monthly_disbursed_loans_data = json_encode($monthly_disbursed_loans_data);
         $loan_statuses = json_encode($loan_statuses);
         $loans_released_monthly = json_encode($loans_released_monthly);
         $loan_collections_monthly = json_encode($loan_collections_monthly);
         //test mpesa here
 
 
         return view('dashboard', compact('monthly_actual_expected_data', 'monthly_disbursed_loans_data', 'loan_statuses'));
             
        
       // return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        if(request('start_date') == "")
        {
            $start_date = Carbon::now()->startOfMonth()->format('Y-m-d'); 
        }
        else{
            $start_date = request('start_date');
        }

        if(request('end_date') == "")
        {
            $end_date = Carbon::now()->format('Y-m-d'); 
        }
        else{
            $end_date = request('end_date');
        }
       $user_id = Auth::user()->id;
        
            
        return view('dashboard.index')
                ->with('start_date',$start_date)
                ->with('end_date',$end_date);
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
        return view('dashboard.edit');
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
}