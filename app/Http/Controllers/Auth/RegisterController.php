<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\SignupMail;
use Illuminate\Support\Facades\Mail;
use App\Models\company;
use Illuminate\Support\Str;
use App\Helpers\SmsHelper;
use Carbon\Carbon;
use App\Models\plan;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'required|numeric|min:8|unique:users',
            'username' => 'required|string|min:3|unique:users',
            'password' => 'required|string|min:2|confirmed',
            'fname' => 'required',
            'lname' => 'required',
            'plan_id'=> 'required',
        ],
        [
            'phonenumber.required' => 'Phone Number is required!!',
            'email.required' => 'Email Address must not be  empty!!',
            'username.required' => 'username must not be  empty!!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $plan = plan::find($data['plan_id']);
        
        $basic = company::first();

        if ($basic->email_verification == 1) {
            $email_verify = 1;
        } else {
            $email_verify = 1;
        }

        if ($basic->phone_verification == 1) {
            $phone_verify = 1;
        } else {
            $phone_verify = 1;
        }

        if ($basic->bvn_verification == 1) {
            $bvn_verify = 1;
        } else {
            $bvn_verify = 1;
        }

        if ($basic->kyc_verification == 1) {
            $kyc_verify = 1;
        } else {
            $kyc_verify = 1;
        }
       
        if(isset($data['referby'])){
            $referUser = user::where('username',$data['referby'])->first();
        }
    

        $email_code  = strtoupper(Str::random(6));
        $phone_code  = strtoupper(Str::random(6));

        $email_time = Carbon::parse()->addMinutes(5);
        $phone_time = Carbon::parse()->addMinutes(5);

        
        $ref=encrypt($data['password']);

        $user = User::create([
                'name' => $data['fname'] .' '. $data['lname'],
                'fname'=>$data['fname'],
                'username'=>$data['username'],
                'phonenumber'=>$data['phonenumber'],
                'lname'=>$data['lname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'user_img' => 'user-thumb-sm.png',
                'ref'=> $ref,
                'referby' =>  isset($data['referby']) ?  $referUser->id : 0,
                'status'=>1,
                'roleid'=>4,
                'email_verify'=> $email_verify,
                'phone_verify'=> $phone_verify,
                'bvn_verify'=> $bvn_verify,
                'kyc_verify'=> $kyc_verify,
                'email_code'=> $email_code,
                'phone_code'=> $phone_code,
                'phone_time'=> $phone_time,
                'email_time'=> $email_time,
                'plan_id' => $plan->id,
                'plan_name' => $plan->name,
                'plan_contribution_amount' => $plan->contribution_amount,
                'plan_loan_amount' => $plan->mininum_loan_amount,
                'plan_duration' => $plan->duration,
            ]);

            $idcount = user::where('roleid','4')->count();

            if($idcount == 0)
            {
                $idcount = 1;
            }
            else
            {
                $idcount = $idcount;
            }

            
            $id_len =  strlen($idcount);

            $reg_no = "";
            
            if($id_len == 1)
            {
                $reg_no = $basic->contributor_code_prefix . "00" . $idcount;
            }
            else if($id_len == 2)
            {
                $reg_no =  $basic->contributor_code_prefix . "0". $idcount;
            }
            else
            {
                $reg_no = $basic->contributor_code_prefix . $idcount;
            }

            $message = "Your phone verification number with ". $basic->sms_sender." is ".$phone_code;
            if($basic->go_live == 1)
            {
                Mail::to($data['email'])->send(new SignupMail($user));
                SmsHelper::smsv2($data['phonenumber'],$message);
            }

            return $user;
    }
}
