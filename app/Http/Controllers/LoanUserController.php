<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_product;
use App\Models\loan;
use App\Models\loan_interest_method_type;
use App\Models\loan_period_type;
use App\Models\loan_repayment_type;
use App\Models\role_priviledge;
use App\Models\user;
use App\Models\userlogin;
use App\Models\charge;
use App\Models\loan_charge;
use App\Models\loantransaction;
use App\Models\loanrepayment;
use App\Models\loanschedule;
use App\Helpers\GeneralHelper;
use App\Helpers\ImageUploadingHelper;
use App\Models\overide_interest;
use App\Models\loan_product_charge;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Validator;
use Flash;
use DB;
use File;
use auth;

class LoanUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = loan::where('borrower_id',Auth::user()->id)->orderBy('id','desc')->get();
        
        
        return view('user.loan.index')
                  ->with('data',$data);
    }

    public function details($loan_id)
    {
        $user_id = Auth::user()->id; 
        $loan = loan::findorfail($loan_id);
        $loan_product = loan_product::orderby('name','asc')->get();
        $loan_period_type = loan_period_type::get();
        $loan_repayment_type = loan_repayment_type::orderby('sort_order','asc')->get();
        $overide_interest = overide_interest::get();
        $charges = loan_product_charge::join('charges as c','c.id','=','loan_product_charges.charge_id')
                                        ->where('loan_product_charges.loan_product_id',$loan->loan_product_id)
                                        ->get();
        
        
        return view('user.loan.details')
        ->with('loan_product',$loan_product)
        ->with('loan_period_type',$loan_period_type)
        ->with('loan_repayment_type',$loan_repayment_type)
        ->with('overide_interest',$overide_interest)
        ->with('charges',$charges)
        ->with('loan',$loan);
    }

    public function create($product_id)
    {
        $user_id = Auth::user()->id; 
        $point = Auth::user()->point;
        $overide_interest = overide_interest::get();
        $product = loan_product::where('id',$product_id)->first();

        $loan_product = loan_product::where('point','<=',$point)->where('status',1)->get();

        $loan_period_type = loan_period_type::get();
        $loan_repayment_type = loan_repayment_type::orderby('sort_order','asc')->get();

        if (empty($product)) {
            Flash::warning("No loan product set. You must first set a loan product");
            return redirect()->back();
        }

        $charges = loan_product_charge::join('charges as c','c.id','=','loan_product_charges.charge_id')->where('loan_product_charges.loan_product_id',$product_id)->get();
        
                
        return view('user.loan.createloan')
        ->with('loan_product',$loan_product)
        ->with('product',$product)
        ->with('product_id',$product_id)
        ->with('charges',$charges)
        ->with('overide_interest',$overide_interest)
        ->with('loan_period_type',$loan_period_type)
        ->with('loan_repayment_type',$loan_repayment_type); 
    }

    public function store(Request $request)
    { 
        $loan_product = loan_product::where('id',$request->loan_product_id)->first();
        
        $date = Carbon::now();
        if ($request->principal > $loan_product->maximum_principal) {
            session()->flash('warning',"Principal Amount Greater than maximum " +  $loan_product->maximum_principal );
            return redirect()->back()->withInput();
        }

        if ($request->principal < $loan_product->minimum_principal) {
            session()->flash('warning',"Principal Amount Less than Minimum " +  $loan_product->minimum_principal );
            return redirect()->back()->withInput();
        }

        $loan = new loan();
        $loan->principal = $request->principal;
        $loan->borrower_id = Auth::user()->id;
        $loan->loan_product_id = $request->loan_product_id;
        $loan->reference = strtoupper(Str::random(10));;
        $loan->release_date = $date;
        $date1 = explode('-', $date);
        $loan->month = $date1[1];
        $loan->year = $date1[0];
        $loan->interest_method = $loan_product->interest_method;
        $loan->interest_rate = $loan_product->interest_rate;
        $loan->interest_period = $request->interest_period;
        $loan->override_interest = $loan_product->override_interest;
        $loan->override_interest_amount = $loan_product->override_interest_amount;
        $loan->loan_duration = $request->loan_duration;
        $loan->loan_duration_type = $request->loan_duration_type;
        $loan->repayment_cycle = $request->repayment_id;
        $loan->grace_on_interest_charged = $loan_product->grace_charge_on_interest;

        $files = ImageUploadingHelper::upload_image("documents/loan/",request('loan_doc'),$request);

        $loan->files = $files;
        $loan->description = $request->description;

        $loan->loan_status = 'open';
        $loan->status = 'pending';
        $loan->applied_amount = $request->principal;

        $loan->save();


        $charges = loan_product_charge::join('charges as c','c.id','=','loan_product_charges.charge_id')
                                        ->select('c.id','c.amount')
                                        ->where('loan_product_id',$request->loan_product_id)
                                        ->get();


        if($charges != null || $charges != "")
        {
            foreach($charges as $charge)
            {
                $loan_charge = new loan_charge();
                $loan_charge->user_id = Auth::user()->id;
                $loan_charge->charge_id = $charge->charge_id;
                $loan_charge->loan_id = $loan->id;
                $loan_charge->amount = $charge->amount;
                $loan_charge->created_at = $date;
                $loan_charge->updated_at = $date;

                $loan_charge->save();
            }
            
        }


        $period = GeneralHelper::loan_period($loan->id);
        $loan = loan::find($loan->id);
        if ($loan->repayment_cycle == 'daily') {
            $repayment_cycle = 'day';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' days')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'weekly') {
            $repayment_cycle = 'week';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' weeks')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'monthly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'bi_monthly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'quarterly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'semi_annually') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'yearly') {
            $repayment_cycle = 'year';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' years')),
                'Y-m-d');
        }
        $loan->save();
        

        GeneralHelper::generate_payment_schedule($loan,$date);
        GeneralHelper::audit_trail("Added loan with id:" . $loan->id);
        session()->flash('success',"Your loan was created successfully");
        
        return redirect()->route('user.loan.index');
    }


    public function update(Request $request)
    { 
        $loan_product = loan_product::where('id',$request->loan_product_id)->first();
        $date = Carbon::now();
        if ($request->principal > $loan_product->maximum_principal) {
            session()->flash('warning',"Principal Amount Greater than maximum " +  $loan_product->maximum_principal );
            return redirect()->back()->withInput();
        }

        if ($request->principal < $loan_product->minimum_principal) {
            session()->flash('warning',"Principal Amount Less than Minimum " +  $loan_product->minimum_principal );
            return redirect()->back()->withInput();
        }

       

        $loan = loan::find($request->loan_id);
        $loan->principal = $request->principal;
        $loan->borrower_id = Auth::user()->id;
        $loan->loan_product_id = $request->loan_product_id;
        $loan->release_date = $date;
        $date1 = explode('-', $date);
        $loan->month = $date1[1];
        $loan->year = $date1[0];
        $loan->interest_method = $loan_product->interest_method;
        $loan->interest_rate = $loan_product->interest_rate;
        $loan->interest_period = $request->interest_period;
        $loan->override_interest = $loan_product->override_interest;
        $loan->override_interest_amount = $loan_product->override_interest_amount;
        $loan->loan_duration = $request->loan_duration;
        $loan->loan_duration_type = $request->loan_duration_type;
        $loan->repayment_cycle = $request->repayment_id;
        $loan->grace_on_interest_charged = $loan_product->grace_charge_on_interest;
        $loan->description = $request->description;
        $loan->updated_at = $date;

        $loan->loan_status = 'open';
        $loan->status = 'pending';
        $loan->applied_amount = $request->principal;

        $loan->save();

        DB::delete('delete from loan_schedules where loan_id = ?',[$loan->id]);

        $loan_repayment = loanrepayment::where('loan_id', $loan->id);
        $loan_repayment->delete();

        $loan_charges = loan_charge::where('loan_id',$loan->id);
        $loan_charges->delete();


        $charges = loan_product_charge::join('charges as c','c.id','=','loan_product_charges.charge_id')
                                        ->select('c.id','c.amount')
                                        ->where('loan_product_id',$request->loan_product_id)
                                        ->get();

        

        
        if($charges != null || $charges != "")
        {
            foreach($charges as $charge)
            {
                $loan_charge = new loan_charge();
                $loan_charge->user_id = Auth::user()->id;
                $loan_charge->charge_id = $charge->id;
                $loan_charge->loan_id = $loan->id;
                $loan_charge->amount = $charge->amount;
                $loan_charge->created_at = $date;
                $loan_charge->updated_at = $date;

                $loan_charge->save();
            }
            
        }


        $period = GeneralHelper::loan_period($loan->id);
        $loan = Loan::find($loan->id);
        if ($loan->repayment_cycle == 'daily') {
            $repayment_cycle = 'day';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' days')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'weekly') {
            $repayment_cycle = 'week';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' weeks')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'monthly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'bi_monthly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'quarterly') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'semi_annually') {
            $repayment_cycle = 'month';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' months')),
                'Y-m-d');
        }
        if ($loan->repayment_cycle == 'yearly') {
            $repayment_cycle = 'year';
            $loan->maturity_date = date_format(date_add(date_create($request->first_payment_date),
                date_interval_create_from_date_string($period . ' years')),
                'Y-m-d');
        }
        $loan->save();
        
        GeneralHelper::generate_payment_schedule($loan,$date);
        GeneralHelper::audit_trail("Editted loan with id:" . $request->loan_id);
        session()->flash('success',"Your loan was updated successfully");
        return redirect('user/loan-details/' . $request->loan_id );
    }
}