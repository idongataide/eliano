<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_product;
use App\Models\loan_interest_method_type;
use App\Models\loan_period_type;
use App\Models\loan_repayment_method;
use App\Models\loanrepayment;
use App\Models\userpaymentstatus;
use App\Models\userpayment;
use App\Models\loan_product_charge;
use App\Models\loan_repayment_type;
use App\Models\role_priviledge;
use App\Models\loan_charge;
use App\Models\user;
use App\Models\loan;
use App\Models\charge;
use App\Models\loan_status;
use App\Models\loantransaction;
use App\Models\loanschedule;
use App\Helpers\GeneralHelper;
use App\Helpers\BonusHelper;

use Validator;
use Flash;
use DB;
use File;
use auth;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $loan = loan::orderby('id','desc')->get();

        return view('admin.loan.loan')
               ->with('loan',$loan);
    }
    public function awaitingdisburstment()
    {
        $loan = loan::where('status','approved')->orderby('id','desc')->get();

        return view('admin.loan.awaitingdisburstment')
               ->with('loan',$loan);
    }
    public function pendingapproval()
    {
        $loan = loan::where('status','pending')->orderby('id','desc')->get();

        return view('admin.loan.pendingapproval')
               ->with('loan',$loan);
    }
    public function details($loan_id)
    {
        $loan = loan::where('id',$loan_id)->first();
        $borrower = user::where('id',$loan->borrower_id)->first();
        $loan_status = loan_status::where('active',1)->get();
        $date = date('Y-m-d');
        
        return view('admin.loan.details')
                ->with('borrower',$borrower)
                ->with('date',$date)
                ->with('loan_status',$loan_status)
                ->with('loan',$loan);
    }

    public function post_loan_task(Request $request)
    {
        $id = $request->loan_id;

        switch ($request->status_id) {
            case 'approved':
                $loan = loan::find($id);
                $loan->status = 'approved';
                $loan->approved_date = $request->date;
                $loan->approved_notes = $request->description;
                $loan->approved_by_id = Auth::user()->id;
                if (empty($request->principal)) {
                    $loan->approved_amount = $loan->principal;
                    DB::delete('delete from loan_schedules where loan_id = ?',[$loan->id]);
                    GeneralHelper::generate_payment_schedule($loan,$request->date);
                    
                }
                else
                {
                    $loan->approved_amount = $request->principal;
                    $loan->principal = $request->principal;
                    DB::delete('delete from loan_schedules where loan_id = ?',[$loan->id]);
                    GeneralHelper::generate_payment_schedule($loan,$request->date);
                }
                
                $loan->save();

                BonusHelper::federal_bonus($id,"pending");
                BonusHelper::referal_bonus($id,'refferal_loan');

               
                GeneralHelper::audit_admin_trail("Approved loan with id:" . $loan->id,Auth::user()->id,Auth::user()->name);
                Flash::success('Loan was approved successfully');
                return redirect('admin/loans/details/' . $id );
              break;
            case 'disbursed':
                    $loan = loan::find($id);
                    $this->disburse($request,$loan);
                    return redirect('admin/loans/details/' . $id );
              break;
            case 'declined':
                $loan = loan::find($id);
                $loan->status = 'declined';
                $loan->declined_date = $request->date;
                $loan->declined_notes = $request->description;
                $loan->declined_by_id = Auth::user()->id;
                $loan->save();
                BonusHelper::federal_bonus($id,"declined");
                GeneralHelper::audit_trail("Declined loan with id:" . $loan->id);
                Flash::success('Loan was declined successfully');
                return redirect('admin/loans/details/' . $id );
             
              break;

            case 'withdrawn':
                $loan = loan::find($id);
                $loan->status = 'withdrawn';
                $loan->withdrawn_date = $request->date;
                $loan->withdrawn_notes = $request->description;
                $loan->withdrawn_by_id = Auth::user()->id;
                $loan->save();
                BonusHelper::federal_bonus($id,"declined");
                GeneralHelper::audit_admin_trail("Withdrawn loan with id:" . $loan->id,Auth::user()->id,Auth::user()->name);
                Flash::success('Loan was Withdrawn successfully');
                return redirect('admin/loans/details/' . $id );
             
              break;

              case 'written_off':
                $loan = Loan::find($id);
                $loan->status = 'written_off';
                $loan->written_off_date = $request->date;
                $loan->written_off_notes = $request->written_off_notes;
                $loan->written_off_by_id = Auth::user()->id;
                $loan->save();

                $amount = GeneralHelper::loan_due_items($loan->id)["principal"] - GeneralHelper::loan_paid_items($loan->id)["principal"];
                $loan_transaction = new loantransaction();
                $loan_transaction->user_id = Auth::user()->id;
                $loan_transaction->loan_id = $loan->id;
                $loan_transaction->borrower_id = $loan->borrower_id;
                $loan_transaction->transaction_type = "write_off";
                $loan_transaction->date = $request->date;
                $loan_transaction->reversible = 1;
                $date = explode('-', $request->date);
                $loan_transaction->year = $date[0];
                $loan_transaction->month = $date[1];
                $loan_transaction->credit = GeneralHelper::loan_total_balance($loan->id);
                $loan_transaction->notes = $request->description;
                $loan_transaction->save();
                      
                GeneralHelper::audit_admin_trail("Write Off loan with id:" . $loan->id,Auth::user()->id,Auth::user()->name);
                Flash::success('Loan was Write off successfully');
                return redirect('admin/loans/details/' . $loan->id);
             
              break;
             
            default:
              
          }
    }

    

    public function disburse(Request $request, $loan)
    {
        
        if ($request->first_payment_date < $request->disbursed_date) {
            Flash::warning('Disbursment date is greater than first payment date.');
            return redirect()->back()->withInput();
        }

        //delete previously created schedules and payments
        DB::delete('delete from loan_schedules where loan_id = ?',[$loan->id]);

        $loan_repayment = loanrepayment::where('loan_id', $loan->id);
        $loan_repayment->delete();

        $loan_charges = loan_charge::where('loan_id',$loan->id);
        $loan_charges->delete();

        $charges = loan_product_charge::join('charges as c','c.id','=','loan_product_charges.charge_id')
                                        ->select('c.id','c.amount')
                                        ->where('loan_product_id',$loan->loan_product_id)
                                        ->get();

        $date = date('Y-m-d');

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



        $interest_rate = GeneralHelper::determine_interest_rate($loan->id);
        $period = GeneralHelper::loan_period($loan->id);

        $loan = loan::find($loan->id);
        
        if ($loan->repayment_cycle == 'daily') {
            $repayment_cycle = '1 days';
            $repayment_type = 'days';
        }
        if ($loan->repayment_cycle == 'weekly') {
            $repayment_cycle = '1 weeks';
            $repayment_type = 'weeks';
        }
        if ($loan->repayment_cycle == 'monthly') {
            $repayment_cycle = 'month';
            $repayment_type = 'months';
        }
        if ($loan->repayment_cycle == 'bi_monthly') {
            $repayment_cycle = '2 months';
            $repayment_type = 'months';

        }
        if ($loan->repayment_cycle == 'quarterly') {
            $repayment_cycle = '4 months';
            $repayment_type = 'months';
        }
        if ($loan->repayment_cycle == 'semi_annually') {
            $repayment_cycle = '6 months';
            $repayment_type = 'months';
        }
        if ($loan->repayment_cycle == 'yearly') {
            $repayment_cycle = '1 years';
            $repayment_type = 'years';
        }

        $disbursed_date = $request->date;
        
        if (empty($request->first_payment_date)) {
            $first_payment_date = date_format(date_add(date_create($disbursed_date),
                date_interval_create_from_date_string($repayment_cycle)),'Y-m-d');
        } else {
            $first_payment_date = $request->first_payment_date;
        }
        
        $loan->maturity_date = date_format(date_add(date_create($first_payment_date),
            date_interval_create_from_date_string($period . ' ' . $repayment_type)),'Y-m-d');
        $loan->status = 'disbursed';
        $loan->loan_disbursed_by_id = Auth::user()->id;
        $loan->disbursed_notes = $request->description;
        $loan->first_payment_date = $first_payment_date;
        $loan->disbursed_date = $disbursed_date;
        $loan->release_date = $disbursed_date;
        $date = explode('-', $disbursed_date);
        $loan->month = $date[1];
        $loan->year = $date[0];
        $loan->save();

        //generate schedules until period finished
        $next_payment = $first_payment_date;
        $balance = $loan->principal;
        $total_interest = 0;
        for ($i = 1; $i <= $period; $i++) {
            $loan_schedule = new loanschedule();

            $loan_schedule->loan_id = $loan->id;
            $loan_schedule->borrower_id = $loan->borrower_id;
            $loan_schedule->description = 'repayment';
            $loan_schedule->due_date = $next_payment;
            $date = explode('-', $next_payment);
            $loan_schedule->month = $date[1];
            $loan_schedule->year = $date[0];
            //determine which method to use
            $due = 0;
            //reducing balance equal installments
            if ($loan->interest_method == 'declining_balance_equal_installments') {
                $due = GeneralHelper::amortized_monthly_payment($loan->id, $loan->principal);
                //determine if we have grace period for interest
                $interest = ($interest_rate * $balance);
                $loan_schedule->principal = ($due - $interest);
                if ($loan->grace_on_interest_charged >= $i) {
                    $loan_schedule->interest = 0;
                } else {
                    $loan_schedule->interest = $interest;
                }
                $loan_schedule->due = $due;
                //determine next balance
                $balance = ($balance - ($due - $interest));
                $loan_schedule->principal_balance = $balance;

            }
            //reducing balance equal principle
            if ($loan->interest_method == 'declining_balance_equal_principal') {
                $principal = $loan->principal / $period;
                $loan_schedule->principal = ($principal);
                $interest = ($interest_rate * $balance);
                if ($loan->grace_on_interest_charged >= $i) {
                    $loan_schedule->interest = 0;
                } else {
                    $loan_schedule->interest = $interest;
                }
                $loan_schedule->due = $principal + $interest;
                //determine next balance
                $balance = ($balance - ($principal + $interest));
                $loan_schedule->principal_balance = $balance;

            }
            //flat  method
            if ($loan->interest_method == 'flat_rate') {
                $principal = $loan->principal / $period;
                $interest = ($interest_rate * $loan->principal);
                if ($loan->grace_on_interest_charged >= $i) {
                    $loan_schedule->interest = 0;
                } else {
                    $loan_schedule->interest = $interest;
                }
                $loan_schedule->principal = $principal;
                $loan_schedule->due = $principal + $interest;
                //determine next balance
                $balance = ($balance - $principal);
                $loan_schedule->principal_balance = $balance;
            }
            //interest only method
            if ($loan->interest_method == 'interest_only') {
                if ($i == $period) {
                    $principal = $loan->principal;
                } else {
                    $principal = 0;
                }
                $interest = ($interest_rate * $loan->principal);
                if ($loan->grace_on_interest_charged >= $i) {
                    $loan_schedule->interest = 0;
                } else {
                    $loan_schedule->interest = $interest;
                }
                $loan_schedule->principal = $principal;
                $loan_schedule->due = $principal + $interest;
                //determine next balance
                $balance = ($balance - $principal);
                $loan_schedule->principal_balance = $balance;
            }
            $total_interest = $total_interest + $interest;
            //determine next due date
            if ($loan->repayment_cycle == 'daily') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('1 days')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'weekly') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('1 weeks')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'monthly') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('1 months')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'bi_monthly') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('2 months')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'quarterly') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('4 months')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'semi_annually') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('6 months')),
                    'Y-m-d');
            }
            if ($loan->repayment_cycle == 'yearly') {
                $next_payment = date_format(date_add(date_create($next_payment),
                    date_interval_create_from_date_string('1 years')),
                    'Y-m-d');
            }
            if ($i == $period) {
                $loan_schedule->principal_balance = round($balance);
            }
            $loan_schedule->save();
        }

        $loan = loan::find($loan->id);
        $loan->maturity_date = $next_payment;
        $loan->save();

        $charges = loan_charge::join('charges as c','c.id','=','loan_charges.charge_id')
                                        ->select('c.id','c.amount','c.charge_option','c.charge_type')
                                        ->where('loan_charges.loan_id',$loan->id)
                                        ->get();


            

        $fees_disbursement = 0;
        $fees_installment = 0;
        $fees_due_date = [];
        $fees_due_date_amount = 0;

        foreach ($charges as $key) {
            if (!empty($key)) {
                if ($key->charge_type == "disbursement") {
                    if ($key->charge_option == "fixed") {
                        $fees_disbursement = $fees_disbursement + $key->amount;
                    } else {
                        if ($key->charge_option == "principal_due") {
                            $fees_disbursement = $fees_disbursement + ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "principal_interest") {
                            $fees_disbursement = $fees_disbursement + ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                        if ($key->charge_option == "interest_due") {
                            $fees_disbursement = $fees_disbursement + ($key->amount * $total_interest) / 100;
                        }
                        if ($key->charge_option == "original_principal") {
                            $fees_disbursement = $fees_disbursement + ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "total_due") {
                            $fees_disbursement = $fees_disbursement + ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                    }
                }
                if ($key->charge_type == "installment_fee") {
                    if ($key->charge_option == "fixed") {
                        $fees_installment = $fees_installment + $key->amount;
                    } else {
                        if ($key->charge_option == "principal_due") {
                            $fees_installment = $fees_installment + ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "principal_interest") {
                            $fees_installment = $fees_installment + ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                        if ($key->charge_option == "interest_due") {
                            $fees_installment = $fees_installment + ($key->amount * $total_interest) / 100;
                        }
                        if ($key->charge_option == "original_principal") {
                            $fees_installment = $fees_installment + ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "total_due") {
                            $fees_installment = $fees_installment + ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                    }
                }
                if ($key->charge_type == "specified_due_date") {
                    if ($key->charge_option == "fixed") {
                        $fees_due_date_amount = $fees_due_date_amount + $key->amount;
                        $fees_due_date[$key->date] = $key->amount;
                    } else {
                        if ($key->charge_option == "principal_due") {
                            $fees_due_date_amount = $fees_due_date_amount + ($key->amount * $loan->principal) / 100;
                            $fees_due_date[$key->date] = ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "principal_interest") {
                            $fees_due_date_amount = $fees_due_date_amount + ($key->amount * ($loan->principal + $total_interest)) / 100;
                            $fees_due_date[$key->date] = ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                        if ($key->charge_option == "interest_due") {
                            $fees_due_date_amount = $fees_due_date_amount + ($key->amount * $total_interest) / 100;
                            $fees_due_date[$key->date] = ($key->amount * $total_interest) / 100;
                        }
                        if ($key->charge_option == "original_principal") {
                            $fees_due_date_amount = $fees_due_date_amount + ($key->amount * $loan->principal) / 100;
                            $fees_due_date[$key->date] = ($key->amount * $loan->principal) / 100;
                        }
                        if ($key->charge_option == "total_due") {
                            $fees_due_date_amount = $fees_due_date_amount + ($key->amount * ($loan->principal + $total_interest)) / 100;
                            $fees_due_date[$key->date] = ($key->amount * ($loan->principal + $total_interest)) / 100;
                        }
                    }
                }
            }
        }

        

        //add disbursal transaction
        $loan_transaction = new loantransaction();
        $loan_transaction->user_id = Auth::user()->id;
        $loan_transaction->loan_id = $loan->id;
        $loan_transaction->borrower_id = $loan->borrower_id;
        $loan_transaction->transaction_type = "disbursement";
        $loan_transaction->date = $disbursed_date;
        $date = explode('-', $disbursed_date);
        $loan_transaction->year = $date[0];
        $loan_transaction->month = $date[1];
        $loan_transaction->debit = $loan->principal;
        $loan_transaction->save();


        //add interest transaction
        $loan_transaction = new loantransaction();
        $loan_transaction->user_id = Auth::user()->id;
        $loan_transaction->loan_id = $loan->id;
        $loan_transaction->borrower_id = $loan->borrower_id;
        $loan_transaction->transaction_type = "interest";
        $loan_transaction->date = $disbursed_date;
        $date = explode('-', $disbursed_date);
        $loan_transaction->year = $date[0];
        $loan_transaction->month = $date[1];
        $loan_transaction->debit = $total_interest;
        $loan_transaction->save();


        //add fees transactions
        if ($fees_disbursement > 0) {
            $loan_transaction = new loantransaction();
            $loan_transaction->user_id = Auth::user()->id;
            $loan_transaction->loan_id = $loan->id;
            $loan_transaction->borrower_id = $loan->borrower_id;
            $loan_transaction->transaction_type = "disbursement_fee";
            $loan_transaction->date = $disbursed_date;
            $date = explode('-', $disbursed_date);
            $loan_transaction->year = $date[0];
            $loan_transaction->month = $date[1];
            $loan_transaction->debit = $fees_disbursement;
            $loan_transaction->save();


            $loan_transaction = new loantransaction();
            $loan_transaction->user_id = Auth::user()->id;
            $loan_transaction->loan_id = $loan->id;
            $loan_transaction->borrower_id = $loan->borrower_id;
            $loan_transaction->transaction_type = "repayment_disbursement";
            $loan_transaction->date = $disbursed_date;
            $date = explode('-', $disbursed_date);
            $loan_transaction->year = $date[0];
            $loan_transaction->month = $date[1];
            $loan_transaction->credit = $fees_disbursement;
            $loan_transaction->save();

        }
        if ($fees_installment > 0) {
            $loan_transaction = new loantransaction();
            $loan_transaction->user_id = Auth::user()->id;
            $loan_transaction->loan_id = $loan->id;
            $loan_transaction->borrower_id = $loan->borrower_id;
            $loan_transaction->transaction_type = "installment_fee";
            $loan_transaction->reversible = 1;
            $loan_transaction->date = $disbursed_date;
            $date = explode('-', $disbursed_date);
            $loan_transaction->year = $date[0];
            $loan_transaction->month = $date[1];
            $loan_transaction->debit = $fees_installment;
            $loan_transaction->save();


            //add installment to schedules
            foreach (loanschedule::where('loan_id', $loan->id)->get() as $key) {
                $schedule = loanschedule::find($key->id);
                $schedule->fees = $fees_installment;
                $schedule->save();
            }
        }
        if ($fees_due_date_amount > 0) {
          foreach ($fees_due_date as $key => $value) {
            $due_date = GeneralHelper::determine_due_date($loan->id, $key);
                 if (!empty($due_date)) {
                   $schedule = loanschedule::where('loan_id', $loan->id)->where('due_date', $due_date)->first();
                    $schedule->fees = $schedule->fees + $value;
                   $schedule->save();
                   $loan_transaction = new loantransaction();
                   $loan_transaction->user_id = Auth::user()->id;
                   $loan_transaction->loan_id = $loan->id;
                   $loan_transaction->loan_schedule_id = $schedule->id;
                   $loan_transaction->reversible = 1;
                   $loan_transaction->borrower_id = $loan->borrower_id;
                   $loan_transaction->transaction_type = "specified_due_date_fee";
                   $loan_transaction->date = $due_date;
                   $date = explode('-', $due_date);
                   $loan_transaction->year = $date[0];
                   $loan_transaction->month = $date[1];
                   $loan_transaction->debit = $value;
                   $loan_transaction->save();
               }
            }

        }
        
        GeneralHelper::audit_admin_trail("Disbursed loan with id:" . $loan->id,Auth::user()->id,Auth::user()->name);
        Flash::success('Loan disbursed was posted successfully');
       
    }

    public function getRepayment()
    {
        $data = userpayment::orderby('id','desc')->get();

        return view('admin.loan.repayment')
        ->with('data',$data);
    }
    public function getrepaymentdetail($payment_id)
    {
        $payment = userpayment::findorfail($payment_id);
        $loan = loan::where('id',$payment->loan_id)->get();
        $paymentmethod = loan_repayment_method::get();
        $status = userpaymentstatus::where('active',1)->get();

        return view('admin.loan.repaymentdetails')
                ->with('data',$payment)
                ->with('status',$status)
                ->with('loan',$loan)
                ->with('payment_method',$paymentmethod);
    }

    public function rejectrepayment($id)
    {
        $payment = userpayment::findorfail($id);
        $loan_transaction = loantransaction::where('user_payment_id',$id)->first();

       
        if(!empty($loan_transaction))
        {
            $loan_transaction->delete();
        }

        $payment->status = "rejected";
        $payment->save();

        
        Flash::success("Repayment was rejected successfully");
        return redirect()->route('admin.loan.repayment');
    }

    public function storeRepayment(Request $request)
    {
        $loan = loan::find($request->loan_id);
        $collection = userpayment::findorfail($request->payment_id);

        if(empty($collection))
        {
            Flash::warning("Invalid Payment");
            return redirect()->back()->withInput();
        }
        

        //$schedule = loanschedule::where('loan_id',$request->loan_id)->

        
        if($request->status_id == "approved")
        {
            if($collection->status == "approved")
            {
                Flash::warning("Approved Already");
                return redirect()->back()->withInput();
            }

            if ($collection->amount > round(GeneralHelper::loan_total_balance($loan->id), 2)) {
                Flash::warning("Amount is more than the balance(" . GeneralHelper::loan_total_balance($loan->id) . ')');
                return redirect()->back()->withInput();
    
            }
            if ($collection->payment_date > date("Y-m-d")) {
                Flash::warning('Future date error');
                return redirect()->back()->withInput();
    
            }
            if ($collection->payment_date < $loan->disbursed_date) {
                Flash::warning('Early date error');
                return redirect()->back()->withInput();
    
            }
             
            
            //add interest transaction
            $loan_transaction = new loantransaction();
            $loan_transaction->user_id = Auth::user()->id;
            $loan_transaction->loan_id = $collection->loan_id;
            $loan_transaction->borrower_id = $collection->borrower_id;
            //$loan_transaction->loan_schedule_id = $collection->borrower_id;
            $loan_transaction->transaction_type = "repayment";
            $loan_transaction->receipt = $collection->teller;
            $loan_transaction->date = $collection->payment_date;
            $loan_transaction->reversible = 1;
            $loan_transaction->repayment_method_id = $collection->repayment_method;
            $date = explode('-', $collection->payment_date);
            $loan_transaction->year = $date[0];
            $loan_transaction->month = $date[1];
            $loan_transaction->credit = $collection->amount;
            $loan_transaction->notes = $request->remark;
            $loan_transaction->user_payment_id = $collection->id;
            $loan_transaction->save();


            //fire payment added event
            //debit and credit the necessary accounts
            //$allocation = GeneralHelper::loan_allocate_payment($loan_transaction);
            //return $allocation;

            BonusHelper::loan_repayment_bonus($loan->id);
            GeneralHelper::CheckOverdueTimelyLoanRepayment($loan->id);
            BonusHelper::refferal_bonus($loan->id,'refferal_repayment');
            

            //update loan status if need be
            if (round(GeneralHelper::loan_total_balance($loan->id)) <= 0) {
                BonusHelper::refferal_bonus($loan->id,"final_refferal_repayment",$collection->payment_date);//final monthly refferal loan repayment
                $l = loan::find($loan->id);
                $l->status = "closed";
                $l->save();
            }
        }

            
        $userpayment = userpayment::find($collection->id);
        $userpayment->status = $request->status_id;
        $userpayment->save();
        
        
        //event(new RepaymentCreated($loan_transaction));

        GeneralHelper::audit_admin_trail("Added repayment for loan with id:" . $loan->id,Auth::user()->id,Auth::user()->name);
        Flash::success("Repayment successfully saved");
        return redirect()->route('admin.loan.repayment');

    }
}