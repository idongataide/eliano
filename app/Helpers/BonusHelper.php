<?php

namespace App\Helpers;

use Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use File;
use Validator;
use App\Models\bonus;
use App\Models\bonuscategory;
use App\Models\bonustype;
use App\Models\AuditTrail;
use App\Models\loan;
use App\Models\notification;
use App\Models\user;


class BonusHelper
{
    public static function federal_bonus($loan_id,$status)
    {
        $bonustype = bonustype::where('code','federal_loan')->first();
        $loan = loan::find($loan_id);
        $date = date("Y-m-d h:m:s");


        if($status != "approved")
        {
            $bonus = new bonus();

            $bonus->bonus_type = $bonustype->code;
            $bonus->bonus_category = $bonustype->category;
            $bonus->user_id = $loan->borrower_id;
            $bonus->amount = $bonustype->amount;
            $bonus->status = $status;
            $bonus->created_at = $date;
            $bonus->updated_at = $date;
            $bonus->loan_id = $loan->id;
            $bonus->status_date = $date;

            $bonus->save();
        }
        else
        {
            $bonus = bonus::where('loan_id',$loan_id)->where('bonus_type','federal_bonus')->first();
            $bonus->status = "approved";
            $bonus->status_date = $date;
            $bonus->save();

            $user = user::find($loan->borrower_id);

            if($bonustype->category == "point"){
                $user->point = $user->point + $bonustype->amount;
            }
            else{
            $user->point = $user->amount + $bonustype->amount;
            }

            $user->save();

        }
    }
    public static function loan_repayment_bonus($loan_id)
    {
        $bonustype = bonustype::where('code','loan_repayment')->first();
        $loan = loan::find($loan_id);
        $date = date("Y-m-d h:m:s");

        $bonus = new bonus();

        $bonus->bonus_type = $bonustype->code;
        $bonus->bonus_category = $bonustype->category;
        $bonus->user_id = $loan->borrower_id;
        $bonus->amount = $bonustype->amount;
        $bonus->status = 'approved';
        $bonus->created_at = $date;
        $bonus->updated_at = $date;
        $bonus->loan_id = $loan->id;
        $bonus->status_date = $date;

        $bonus->save();


        $user = user::find($loan->borrower_id);

        if($bonustype->category == "point"){
            $user->point = $user->point + $bonustype->amount;
        }
        else{
        $user->point = $user->amount + $bonustype->amount;
        }
        $user->save();
    }

    public static function early_loan_repayment_bonus($loan_id)
    {
        $bonustype = bonustype::where('code','early_loan_repayment')->first();
        $loan = loan::find($loan_id);
        $date = date("Y-m-d h:m:s");

        $bonus = new bonus();

        $bonus->bonus_type = $bonustype->code;
        $bonus->bonus_category = $bonustype->category;
        $bonus->user_id = $loan->borrower_id;
        $bonus->amount = $bonustype->amount;
        $bonus->status = 'approved';
        $bonus->created_at = $date;
        $bonus->updated_at = $date;
        $bonus->loan_id = $loan->id;
        $bonus->status_date = $date;

        $bonus->save();


        $user = user::find($loan->borrower_id);

        if($bonustype->category == "point"){
            $user->point = $user->point + $bonustype->amount;
        }
        else{
        $user->amount = $user->amount + $bonustype->amount;
        }
        $user->save();
    }

    public static function referal_bonus($loan_id,$remark,$payment_date='')
    {
        $bonustype = bonustype::where('code','refferal_bonus')->first();
        $loan = loan::find($loan_id);
        $user = user::find('id',$loan->borrower_id);
        $date = date("Y-m-d h:m:s");

        if($user->referby != "" || $user->referby != "null")
        {
            if($remark == "refferal_loan")
            {
                $record = new notification();
                $record->user_id = $user->referBy;
                $record->category = "refferals";
                $record->message = "You are eligible for referral bonuses from " . $user->name . " loan repayments when they are received.";
                $record->created_at = $date;
                $record->updated_at = $date;
                $record->status = "0";
            }

            if($remark == "refferal_repayment")
            {
                $bonus = new bonus();

                $bonus->bonus_type = $bonustype->code;
                $bonus->bonus_category = $bonustype->category;
                $bonus->user_id = $loan->borrower_id;
                $bonus->amount = $bonustype->amount;
                $bonus->status = 'pending';
                $bonus->created_at = $date;
                $bonus->updated_at = $date;
                $bonus->loan_id = $loan->id;
                $bonus->status_date = $date;
        
                $bonus->save();
            }

            if($remark == "final_refferal_repayment")
            {
               
                $schedule = loanschedule::where('loan_id',$loan->id)->where('principal_balance','=','0')->first();

                if($payment_date <= $schedule->due_date)
                 {
                    $user = user::find($user->referby);
                    $affected = DB::table('bonus')
                                ->where('bonus_type', "refferal_bonus")
                                ->where('loan_id',$loan->id)
                                ->update(['status' => "approved"]);

                    $refferal_bonus = bonus::where('bonus_type','refferal_bonus')
                                            ->where('loan_id',$loan->id)
                                            ->where('status','approved')
                                            ->get();


                    foreach($refferal_bonus as $row){
                        if($bonustype->category == "point"){
                            $user->point = $user->point + $bonustype->amount;
                        }
                        else{
                        $user->amount = $user->amount + $bonustype->amount;
                        }
                        $user->save();
                    }
                }
            }
        }
    }        
}