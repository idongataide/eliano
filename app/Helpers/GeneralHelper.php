<?php

namespace App\Helpers;

use Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use File;
use Validator;
use App\Models\loan;
use App\Models\loanschedule;
use App\Models\loantransaction;
use App\Models\loanrepayment;
use App\Models\AuditTrail;
use App\Helpers\BonusHelper;

class GeneralHelper
{

    public static function CheckOverdueTimelyLoanRepayment($loan_id)
    {
        $loan = loan::find($loan_id);
        
        $timely = 0;
        $total_overdue = 0;
        $overdue_date = "";
        $total_till_now = 0;
        $count = 1;
        $total_due = 0;

        $principal_balance = loanschedule::where('loan_id',$loan->id)->sum('principal');
        $payments = GeneralHelper::loan_total_paid($loan->id);

        $total_paid = $payments;
        $next_payment = [];
        $next_payment_amount = "";

        foreach ($loan->schedules as $schedule) {
            $principal_balance = $principal_balance - $schedule->principal;
            $total_due = $total_due + ($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived);
            $paid = 0;
            $paid_by = '';
            $overdue = 0;


            $due = $schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived;
            if ($payments > 0) {
                if ($payments >= $due) {
                    $paid = $due;
                    $payments = $payments - $due;
                    //find the corresponding paid by date
                    $p_paid = 0;
                    foreach (loantransaction::where('loan_id',
                        $loan->id)->where('transaction_type',
                        'repayment')->where('reversed', 0)->orderBy('date',
                        'asc')->get() as $key) {
                        $p_paid = $p_paid + $key->credit;
                        if ($p_paid >= $total_due) {
                            $paid_by = $key->date;
                            if ($key->date > $schedule->due_date && date("Y-m-d") > $schedule->due_date) {
                                $overdue = 1;
                                $total_overdue = $total_overdue + 1;
                                $overdue_date = '';
                            }
                            break;
                        }
                    }
                } else {
                    $paid = $payments;
                    $payments = 0;
                    if (date("Y-m-d") > $schedule->due_date) {
                        $overdue = 1;
                        $total_overdue = $total_overdue + 1;
                        $overdue_date = $schedule->due_date;
                    }
                    $next_payment[$schedule->due_date] = (($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived) - $paid);
                }
            } else {
                if (date("Y-m-d") > $schedule->due_date) {
                   
                    $overdue = 1;
                    $total_overdue = $total_overdue + 1;
                    $overdue_date = $schedule->due_date;
                }
                $next_payment[$schedule->due_date] = (($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived));
            }
            $outstanding = $due - $paid;
        }
        if($overdue==1)
        {
            BonusHelper::federal_bonus($loan->id,'declined');
        }
        if($overdue==0){
            BonusHelper::early_loan_repayment_bonus($loan->id);
        }
    }

    public static function loan_total_balance($id, $date = '')
    {
        if (empty($date)) {
            return GeneralHelper::loan_total_due_amount($id) - GeneralHelper::loan_total_paid($id);
        } else {
            return GeneralHelper::loan_total_due_amount($id, $date) - GeneralHelper::loan_total_paid($id,
                    $date);
        }

    }
    public static function loans_total_due($start_date = '', $end_date = '')
    {
        if (empty($start_date)) {
            $due = 0;
            foreach (loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->get() as $key) {
                $due = $due + GeneralHelper::loan_total_due_amount($key->id);
            }
            return $due;
        } else {
            $due = 0;
            foreach (Loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->whereBetween('release_date',
                [$start_date, $end_date])->get() as $key) {
                $due = $due + GeneralHelper::loan_total_due_amount($key->id);
            }
            return $due;

        }
    }
    public static function loan_total_paid($id, $date = '')
    {
        if (empty($date)) {
            return loantransaction::where('loan_id', $id)->where('transaction_type',
                'repayment')->where('reversed', 0)->sum('credit');
        } else {
            return loantransaction::where('loan_id', $id)->where('transaction_type',
                'repayment')->where('reversed', 0)->where('due_date', '<=', $date)->sum('credit');
        }

    }

    public static function loan_interest($id)
    {
        return loanschedule::where('loan_id', $id)->sum('interest');
    }


    public static function loan_total_paid_period($id, $date)
    {
        return loanrepayment::where('loan_id', $id)->where('due_date', $date)->sum('amount');

    }

    public static function loan_paid_items($id, $start_date = '', $end_date = '')
    {
        $allocation = [];
        $loan = loan::find($id);
        $principal = 0;
        $fees = 0;
        $penalty = 0;
        $interest_waived = 0;
        $interest = 0;

        if (!empty($loan->loan_product)) {
            if (empty($start_date)) {
                $payments = loantransaction::where('loan_id', $id)->where('transaction_type',
                    'repayment')->where('reversed', 0)->sum('credit');
                $interest_waived = loantransaction::where('loan_id', $id)->where('transaction_type',
                    'waiver')->where('reversed', 0)->sum('credit');
            } else {
                $payments = loantransaction::where('loan_id', $id)->where('transaction_type',
                    'repayment')->where('reversed', 0)->whereBetween('date',
                    [$start_date, $end_date])->sum('credit');
                $interest_waived = loantransaction::where('loan_id', $id)->where('transaction_type',
                    'waiver')->where('reversed', 0)->whereBetween('date',
                    [$start_date, $end_date])->sum('credit');
            }
            foreach ($loan->schedules as $schedule) {
                //$schedules have not yet been covered
                if ($payments > 0) {
                    //try to allocate the remaining payment to the respective elements
                    $repayment_order = unserialize($loan->loan_product->repayment_order);
                    foreach ($repayment_order as $order) {
                        if ($order == 'interest') {
                            if ($payments > ($schedule->interest - $schedule->interest_waived)) {
                                $interest = $interest + $schedule->interest - $schedule->interest_waived;
                                $payments = $payments - $schedule->interest - $schedule->interest_waived;
                            } else {
                                $interest = $interest + $payments;
                                $payments = 0;
                            }
                        }
                        if ($order == 'penalty') {
                            if ($payments > $schedule->penalty) {
                                $penalty = $penalty + $schedule->penalty;
                                $payments = $payments - $schedule->penalty;
                            } else {
                                $penalty = $penalty + $payments;
                                $payments = 0;
                            }
                        }
                        if ($order == 'fees') {
                            if ($payments > $schedule->fees) {
                                $fees = $fees + $schedule->fees;
                                $payments = $payments - $schedule->fees;
                            } else {

                                $fees = $fees + $payments;
                                $payments = 0;
                            }

                        }
                        if ($order == 'principal') {
                            if ($payments > $schedule->principal) {
                                $principal = $principal + $schedule->principal;
                                $payments = $payments - $schedule->principal;
                            } else {
                                $principal = $principal + $payments;
                                $payments = 0;
                            }
                        }
                    }
                } else {
                    break;
                }
            }
        }
        $allocation["principal"] = $principal;
        $allocation["interest"] = $interest;
        $allocation["interest_waived"] = $interest_waived;
        $allocation["fees"] = $fees;
        $allocation["penalty"] = $penalty;
        return $allocation;
    }


    public static function loan_due_items($id, $start_date = '', $end_date = '')
    {
        $allocation = [];
        $principal = 0;
        $fees = 0;
        $penalty = 0;
        $interest = 0;
        if (empty($start_date)) {
            $schedules = loanschedule::where('loan_id', $id)->get();
        } else {
            $schedules = loanschedule::where('loan_id', $id)->whereBetween('due_date',
                [$start_date, $end_date])->get();
        }
        foreach ($schedules as $schedule) {
            $interest = $interest + $schedule->interest;
            $penalty = $penalty + $schedule->penalty;
            $fees = $fees + $schedule->fees;
            $principal = $principal + $schedule->principal;
        }
        $allocation["principal"] = $principal;
        $allocation["interest"] = $interest;
        $allocation["fees"] = $fees;
        $allocation["penalty"] = $penalty;
        return $allocation;
    }

    public static function loan_total_due_amount($id, $date = '')
    {
        if (empty($date)) {

            return (GeneralHelper::loan_total_penalty($id) + GeneralHelper::loan_total_fees($id) + GeneralHelper::loan_total_interest($id) + GeneralHelper::loan_total_principal($id) - GeneralHelper::loan_total_interest_waived($id));
        } else {
            return (GeneralHelper::loan_total_penalty($id, $date) + GeneralHelper::loan_total_fees($id,
                    $date) + GeneralHelper::loan_total_interest($id, $date) + GeneralHelper::loan_total_principal($id,
                    $date) - GeneralHelper::loan_total_interest_waived($id, $date));

        }

    }

  
    public static function borrower_loans_total_due($id)
    {

        $due = 0;
        foreach (loan::whereIn('status',
            ['disbursed', 'closed', 'written_off'])->where('borrower_id', $id)->get() as $key) {
            $due = $due + GeneralHelper::loan_total_due_amount($key->id);
        }
        return $due;

    }

    public static function loan_total_interest_waived($id, $date = '')
    {
        if (empty($date)) {
            return loanschedule::where('loan_id', $id)->sum('interest_waived');
        } else {
            return loanschedule::where('loan_id', $id)->where('due_date', '<=', $date)->sum('interest_waived');
        }
    }

    public static function loan_total_principal($id, $date = '')
    {
        if (empty($date)) {
            return loanschedule::where('loan_id', $id)->sum('principal');
        } else {
            return loanschedule::where('loan_id', $id)->where('due_date', '<=', $date)->sum('principal');
        }
    }

    public static function loan_allocate_payment($loan_transaction)
    {

        $allocation = [];
        $loan = $loan_transaction->loan;
        $principal = 0;
        $fees = 0;
        $penalty = 0;
        $interest = 0;
        $amount = $loan_transaction->credit;
        if (!empty($loan->loan_product)) {
            //find all payments up to this date
            //subtract this current payment
            $payments = LoanTransaction::where('loan_id', $loan_transaction->loan_id)->where('transaction_type',
                'repayment')->where('reversed', 0)->where('date', '<=', $loan_transaction->date)->sum('credit')-$amount;
            foreach ($loan->schedules as $schedule) {
                if ($amount > 0) {
                    if (($schedule->principal + $schedule->fees + $schedule->penalty + $schedule->interest - $schedule->interest_waived) < $payments) {
                        $payments = $payments - ($schedule->principal + $schedule->fees + $schedule->penalty + $schedule->interest - $schedule->interest_waived);
                        //these schedules have been covered
                    } else {
                        //$schedules have not yet been covered
                        if ($payments > 0) {
                            //try to allocate the remaining payment to the respective elements
                            $repayment_order = unserialize($loan->loan_product->repayment_order);
                            foreach ($repayment_order as $order) {
                                if ($order == 'interest') {
                                    if ($payments > $schedule->interest - $schedule->interest_waived) {
                                        $schedule_interest = 0;
                                        $payments = $payments - $schedule->interest - $schedule->interest_waived;
                                    } else {
                                        $schedule_interest = $schedule->interest - $schedule->interest_waived - $payments;
                                        $payments = 0;
                                        if ($amount > $schedule_interest) {
                                            $interest = $interest + $schedule_interest;
                                            $amount = $amount - $schedule_interest;
                                        } else {
                                            $interest = $interest + $amount;
                                            $amount = 0;
                                        }
                                    }
                                }
                                if ($order == 'penalty') {
                                    if ($payments > $schedule->penalty) {
                                        $schedule_penalty = 0;
                                        $payments = $payments - $schedule->penalty;
                                    } else {
                                        $schedule_penalty = $schedule->penalty - $payments;
                                        $payments = 0;
                                        if ($amount > $schedule_penalty) {
                                            $penalty = $penalty + $schedule_penalty;
                                            $amount = $amount - $schedule_penalty;
                                        } else {
                                            $penalty = $penalty + $amount;
                                            $amount = 0;
                                        }
                                    }

                                }
                                if ($order == 'fees') {
                                    if ($payments > $schedule->fees) {
                                        $payments = $payments - $schedule->fees;
                                        $schedule_fees = 0;
                                    } else {
                                        $schedule_fees = $schedule->fees - $payments;
                                        $payments = 0;
                                        if ($amount > $schedule_fees) {
                                            $fees = $fees + $schedule_fees;
                                            $amount = $amount - $schedule_fees;
                                        } else {
                                            $fees = $fees + $amount;
                                            $amount = 0;
                                        }
                                    }

                                }
                                if ($order == 'principal') {
                                    if ($payments > $schedule->principal) {
                                        $schedule_principal = 0;
                                        $payments = $payments - $schedule->principal;
                                    } else {
                                        $schedule_principal = $schedule->principal - $payments;
                                        $payments = 0;
                                        if ($amount > $schedule_principal) {
                                            $principal = $principal + $schedule_principal;
                                            $amount = $amount - $schedule_principal;
                                        } else {
                                            $principal = $principal + $amount;
                                            $amount = 0;
                                        }
                                    }

                                }
                            }
                        } else {
                            if ((($schedule->principal + $schedule->fees + $schedule->penalty + $schedule->interest - $schedule->interest_waived)) == $amount) {
                                $principal = $principal + $schedule->principal;
                                $fees = $fees + $schedule->fees;
                                $penalty = $penalty + $schedule->penalty;
                                $interest = $interest + $schedule->interest;
                                $amount = 0;
                                break;
                            } else {
                                //check with loan product
                                $repayment_order = unserialize($loan->loan_product->repayment_order);
                                foreach ($repayment_order as $order) {
                                    if ($order == 'interest') {
                                        if ($amount > $schedule->interest - $schedule->interest_waived) {
                                            $interest = $interest + $schedule->interest - $schedule->interest_waived;
                                            $amount = $amount - $schedule->interest - $schedule->interest_waived;
                                        } else {
                                            $interest = $interest + $amount;
                                            $amount = 0;
                                        }
                                    }
                                    if ($order == 'penalty') {
                                        if ($amount > $schedule->penalty) {
                                            $penalty = $penalty + $schedule->penalty;
                                            $amount = $amount - $schedule->penalty;
                                        } else {
                                            $penalty = $penalty + $amount;
                                            $amount = 0;
                                        }
                                    }
                                    if ($order == 'fees') {
                                        if ($amount > $schedule->fees) {
                                            $fees = $fees + $schedule->fees;
                                            $amount = $amount - $schedule->fees;
                                        } else {
                                            $fees = $fees + $amount;
                                            $amount = 0;
                                        }
                                    }
                                    if ($order == 'principal') {
                                        if ($amount > $schedule->principal) {
                                            $principal = $principal + $schedule->principal;
                                            $amount = $amount - $schedule->principal;
                                        } else {
                                            $principal = $principal + $amount;
                                            $amount = 0;
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    break;
                }
            }
        }
        $allocation["principal"] = $principal;
        $allocation["interest"] = $interest;
        $allocation["fees"] = $fees;
        $allocation["penalty"] = $penalty;
        return $allocation;
    }


    public static function loans_total_principal($start_date = '', $end_date = '')
    {
        if (empty($start_date)) {
            $principal = 0;
            foreach (loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->get() as $key) {
                $principal = $principal + loanschedule::where('loan_id', $key->id)->sum('principal');
            }
            return $principal;
        } else {
            $principal = 0;
            foreach (loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->whereBetween('release_date',
                [$start_date, $end_date])->get() as $key) {
                $principal = $principal + $key->principal;
            }
            return $principal;

        }

    }

    public static function loans_total_paid_item($item, $start_date = '', $end_date = '')
    {
        if (empty($start_date)) {
            $amount = 0;
            foreach (loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->get() as $key) {
                $amount = $amount + GeneralHelper::loan_terms_paid_item($key->id, $item);
            }
            return $amount;
        } else {
            $amount = 0;
            foreach (loan::whereIn('status',
                ['disbursed', 'closed', 'written_off'])->whereBetween('release_date',
                [$start_date, $end_date])->get() as $key) {
                $amount = $amount + GeneralHelper::loan_terms_paid_item($key->id, $item);
            }
            return $amount;

        }

    }

    public static function loan_terms_paid_item($id, $item = 'principal')
    {
        $loan = loan::find($id);
        $principal = 0;
        $interest = 0;
        $penalty = 0;
        $fees = 0;
        $payments = GeneralHelper::loan_total_paid($id);
        $total_principal = GeneralHelper::loan_total_principal($id);
        $total_interest = GeneralHelper::loan_total_interest($id);
        $total_fees = GeneralHelper::loan_total_fees($id);
        $total_penalty = GeneralHelper::loan_total_penalty($id);
        if (!empty($loan->loan_product)) {
            $repayment_order = unserialize($loan->loan_product->repayment_order);
            if ($payments > 0) {
                foreach ($repayment_order as $order) {
                    if ($payments > 0) {
                        if ($order == 'interest') {
                            if ($payments > $total_interest) {
                                $interest = $interest + $total_interest;
                                $payments = $payments - $total_interest;
                            } else {
                                $interest = $interest + $payments;
                                $payments = 0;
                            }
                        }
                        if ($order == 'penalty') {
                            if ($payments > $total_penalty) {
                                $penalty = $penalty + $total_penalty;
                                $payments = $payments - $total_penalty;
                            } else {
                                $penalty = $penalty + $payments;
                                $payments = 0;
                            }
                        }
                        if ($order == 'fees') {
                            if ($payments > $total_fees) {
                                $fees = $fees + $total_fees;
                                $payments = $payments - $total_fees;
                            } else {
                                $fees = $fees + $payments;
                                $payments = 0;
                            }
                        }
                        if ($order == 'principal') {
                            if ($payments > $total_principal) {
                                $principal = $principal + $total_principal;
                                $payments = $payments - $total_principal;
                            } else {
                                $principal = $principal + $payments;
                                $payments = 0;
                            }
                        }

                    }
                }
                //apply remainder to principal
                $principal = $principal + $payments;
            }
        }
        if ($item == 'principal') {
            return $principal;
        }

        if ($item == 'fees') {
            return $fees;
        }
        if ($item == 'penalty') {
            return $penalty;
        }
        if ($item == 'interest') {
            return $interest;
        }
        return $principal;
    }

    public static function generate_payment_schedule($loan, $date)
    {

        $next_payment = $date;
        $interest_rate = GeneralHelper::determine_interest_rate($loan->id);
        $period = GeneralHelper::loan_period($loan->id);
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


    }


    public static function loan_total_interest($id, $date = '')
    {
        if (empty($date)) {
            return loanschedule::where('loan_id', $id)->sum('interest');
        } else {
            return loanschedule::where('loan_id', $id)->where('due_date', '<=', $date)->sum('interest');
        }
    }

    public static function loan_total_penalty($id, $date = '')
    {
        if (empty($date)) {
            return loanschedule::where('loan_id', $id)->sum('penalty');
        } else {
            return loanschedule::where('loan_id', $id)->where('due_date', '<=', $date)->sum('penalty');
        }
    }

    public static function loan_total_fees($id, $date = '')
    {
        if (empty($date)) {
            return loanschedule::where('loan_id', $id)->sum('fees');
        } else {
            return loanschedule::where('loan_id', $id)->where('due_date', '<=',
                $date)->sum('fees');
        }
    }

    public static function determine_interest_rate($id)
    {
        $loan = loan::find($id);
        $interest = '';
        if ($loan->override_interest == 1) {
            $interest = $loan->override_interest_amount;
        } else {
            if ($loan->repayment_cycle == 'annually') {
                //return the interest per year
                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate * 12;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate * 52;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 365;
                }
            }
            if ($loan->repayment_cycle == 'semi_annually') {
                //return the interest per semi annually
                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 2;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate * 6;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate * 26;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 182.5;
                }
            }
            if ($loan->repayment_cycle == 'quarterly') {
                //return the interest per quaterly

                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 4;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate * 3;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate * 13;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 91.25;
                }
            }
            if ($loan->repayment_cycle == 'bi_monthly') {
                //return the interest per bi-monthly
                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 6;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate * 2;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate * 8.67;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 58.67;
                }

            }

            if ($loan->repayment_cycle == 'monthly') {
                //return the interest per monthly

                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 12;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate * 1;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate * 4.33;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 30.4;
                }
            }
            if ($loan->repayment_cycle == 'weekly') {
                //return the interest per weekly

                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 52;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate / 4;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 7;
                }
            }
            if ($loan->repayment_cycle == 'daily') {
                //return the interest per day

                if ($loan->interest_period == 'year') {
                    $interest = $loan->interest_rate / 365;
                }
                if ($loan->interest_period == 'month') {
                    $interest = $loan->interest_rate / 30.4;
                }
                if ($loan->interest_period == 'week') {
                    $interest = $loan->interest_rate / 7.02;
                }
                if ($loan->interest_period == 'day') {
                    $interest = $loan->interest_rate * 1;
                }
            }
        }
        return $interest / 100;
    }

    public static function determine_due_date($id, $date)
    {
        $schedule = loanschedule::where('due_date', ' >=', $date)->where('loan_id', $id)->orderBy('due_date',
            'asc')->first();
        if (!empty($schedule)) {
            return $schedule->due_date;
        } else {
            $schedule = loanschedule::where('loan_id',
                $id)->orderBy('due_date',
                'desc')->first();
            if ($date > $schedule->due_date) {
                return $schedule->due_date;
            } else {
                $schedule = loanschedule::where('due_date', '>', $date)->where('loan_id',$id)->orderBy('due_date','asc')->first();
                return $schedule->due_date;
            }

        }
    }

    //determine monthly payment using amortization
    public static function amortized_monthly_payment($id, $balance)
    {
        $loan = loan::find($id);
        $period = GeneralHelper::loan_period($id);
        $interest_rate = GeneralHelper::determine_interest_rate($id);
        //calculate here
        $amount = ($interest_rate * $balance * pow((1 + $interest_rate), $period)) / (pow((1 + $interest_rate),$period) - 1);
        return $amount;
    }



    public static function loan_period($id)
    {
        $loan = loan::find($id);
        $period = 0;
        if ($loan->repayment_cycle == 'annually') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration * 12);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 52);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 365);
            }
        }
        if ($loan->repayment_cycle == 'semi_annually') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration * 2);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration * 6);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 26);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 182.5);
            }
        }
        if ($loan->repayment_cycle == 'quarterly') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration * 12);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 52);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 365);
            }
        }
        if ($loan->repayment_cycle == 'bi_monthly') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration * 6);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration / 2);

            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 8);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 60);
            }
        }

        if ($loan->repayment_cycle == 'monthly') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration * 12);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 4.3);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 30.4);
            }
        }
        if ($loan->repayment_cycle == 'weekly') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration * 52);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration * 4);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 1);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration * 7);
            }
        }
        if ($loan->repayment_cycle == 'daily') {
            if ($loan->loan_duration_type == 'year') {
                $period = ceil($loan->loan_duration * 365);
            }
            if ($loan->loan_duration_type == 'month') {
                $period = ceil($loan->loan_duration * 30.42);
            }
            if ($loan->loan_duration_type == 'week') {
                $period = ceil($loan->loan_duration * 7.02);
            }
            if ($loan->loan_duration_type == 'day') {
                $period = ceil($loan->loan_duration);
            }
        }
        return $period;
    }

    public static function time_ago($eventTime)
    {
        $totaldelay = time() - strtotime($eventTime);
        if ($totaldelay <= 0) {
            return '';
        } else {
            if ($days = floor($totaldelay / 86400)) {
                $totaldelay = $totaldelay % 86400;
                return $days . ' days ago';
            }
            if ($hours = floor($totaldelay / 3600)) {
                $totaldelay = $totaldelay % 3600;
                return $hours . ' hours ago';
            }
            if ($minutes = floor($totaldelay / 60)) {
                $totaldelay = $totaldelay % 60;
                return $minutes . ' minutes ago';
            }
            if ($seconds = floor($totaldelay / 1)) {
                $totaldelay = $totaldelay % 1;
                return $seconds . ' seconds ago';
            }
        }
    }


    public static function audit_trail($notes)
    {
        $audit_trail = new AuditTrail();

        
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->user = Auth::user()->fname . ' ' . Auth::user()->lname;


        $audit_trail->notes = $notes;
        $audit_trail->save();

    }

    public static function loans_total_paid($start_date = '', $end_date = '')
    {

        if (empty($start_date)) {
            $paid = 0;
            foreach (loan::whereIn('status', ['disbursed', 'closed', 'written_off'])->get() as $key) {
                $paid = $paid + loantransaction::where('loan_id',
                        $key->id)->where('transaction_type',
                        'repayment')->where('reversed', 0)->sum('credit');
            }
            return $paid;
        } else {
            $paid = 0;
            foreach (loan::whereIn('status', ['disbursed', 'closed', 'written_off'])->whereBetween('release_date',
                [$start_date, $end_date])->get() as $key) {
                $paid = $paid + loantransaction::where('loan_id',
                        $key->id)->where('transaction_type',
                        'repayment')->where('reversed', 0)->sum('credit');
            }
            return $paid;

        }

    }
    public static function borrower_loans_total_paid($id)
    {

        $paid = 0;
        foreach (loan::whereIn('status',
            ['disbursed', 'closed', 'written_off'])->where('borrower_id', $id)->get() as $key) {
            $paid = $paid + loantransaction::where('loan_id',
                    $key->id)->where('transaction_type',
                    'repayment')->where('reversed', 0)->sum('credit');
        }
        return $paid;

    }

    public static function audit_admin_trail($notes,$user_id, $user)
    {
        $audit_trail = new AuditTrail();

        $audit_trail->user_id = $user_id;
        $audit_trail->user = $user;


        $audit_trail->notes = $notes;
        $audit_trail->save();

    }

    public static function diff_in_months(\DateTime $date1, \DateTime $date2)
    {
        $diff =  $date1->diff($date2);

        $months = $diff->y * 12 + $diff->m + $diff->d / 30;

        return (int) round($months);
    }
    public static function addMonths($date, $months)
    {
        $orig_day = $date->format("d");
        $date->modify("+" . $months . " months");
        while ($date->format("d") < $orig_day && $date->format("d") < 5) {
            $date->modify("-1 day");
        }
    }

}