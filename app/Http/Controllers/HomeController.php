<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Helpers\SmsHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Helpers\ImageUploadingHelper;
use App\Models\verification;
use App\Models\gender;
use App\Models\company;
use App\Models\country;
use App\Models\user;
use App\Models\state;
use App\Models\city;
use App\Models\bank;
use App\Models\security_question;
use App\Models\userlogin;
use App\Models\marital_status;
use App\Models\legal_status;
use App\Models\loan_product;
use App\Models\loan_period_type;
use App\Models\loan_repayment_type;
use App\Models\overide_interest;
use App\Models\charge;
use App\Models\loan_product_charge;
use App\Models\bonus;
use App\Models\plan;
use App\Models\contribution;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->roleid == 5){
            $contribution = contribution::where('merchant_id',Auth::user()->id)->orderby('id','desc')->get();
        }
        else
        {
            $contribution = contribution::where('contributor_id',Auth::user()->id)->orderby('id','desc')->get();
        }
        
        return view('user.home')
            ->with('contribution',$contribution);
    }

    public function authVerification()
    {
        $basic = company::first();

        $user = user::find(Auth::user()->id);
        $gender = gender::get();
        $country = country::orderby('name')->get();
        $bank = bank::orderby('name')->get();
        $state = state::orderby('name')->get();
        $city = city::orderby('name')->get();
        $credential = verification::where('user_id',$user->id)->first();

       
        
        if (Auth()->user()->email_verify == '1' && Auth()->user()->phone_verify == '1' && Auth()->user()->kyc_verify == '1') {
            return redirect()->route('user.home');
        } else {
            return view('user.verification')
                    ->with('data',$user)
                    ->with('gender',$gender)
                    ->with('bank',$bank)
                    ->with('state',$state)
                    ->with('credential',$credential)
                    ->with('city',$city)
                    ->with('country',$country);
        }
    }

    public function sendphonecode(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $basic = company::first();

        $code = strtoupper(Str::random(6));
        $user->phone_time = Carbon::now();
        $user->phone_code = $code;
        $user->save();
            
        
        $message = "Your phone verification number with ". $basic->sms_sender." is ".$code;
        SmsHelper::smsv1($user->phonenumber,$message);


        session()->flash('success', 'Verification Code Sent successfully');
        return back();
    }
    public function getsecurity()
    {
        $user = User::find(Auth::user()->id);
        $securityquestion = security_question::get();
        
        
        return view('user.security')
                    ->with('user',$user)
                    ->with('securityquestion',$securityquestion);
    }
    public function postsecurity(Request $request)
    {
        $oldpassword = request('oldpassword');
        $password = request('newpassword');
        $confirm_password = request('changedpassword');

        $user_id = Auth::user()->id;
        $record = user::findorfail($user_id);

        if($password != ""){
        
            if($password != $confirm_password)
            {
                session()->flash('warning', 'Confirmed Password does not match!');
                return back();
            }

            if(Auth::user()->ref != "")
            {
                $old_ref = decrypt(Auth::user()->ref);
                if(!($old_ref == $oldpassword))
                {
                    session()->flash('warning', 'Old Password does not match!');
                    return back();
                }
            }

            $password = bcrypt($request->input('newpassword'));
            $ref = encrypt($request->input('newpassword'));



            $record->password = $password;
            $record->ref = $ref;
            $record->save();
        }
        
        
       
        $record->security_id = request('question_id');
        $record->security_answer = request('security_answer');
        $record->save();


        session()->flash('success', 'Password was changed successfuly!');
        return back();
    }
    public function getactivity()
    {
        $user_id = Auth::user()->id;
        $data = userlogin::where('user_id',$user_id)->orderby('id','desc')->get();

        return view('user.activity')
                 ->with('data',$data);
    }

   

    public function myprofile()
    {
        $user_id = Auth::user()->id;
        $data = user::find($user_id);

        $gender = gender::get();
        $country = country::get();
        $state = state::orderby('name','asc')->get();
        $city = city::orderby('name','asc')->get();
        $bank = bank::orderby('name','asc')->get();
        $marital_status = marital_status::get();
        $plan = plan::get();
        $legal_status = legal_status::get();

        

        return view('user.profile')
                    ->with('data',$data)
                    ->with('bank',$bank)
                    ->with('plan',$plan)
                    ->with('gender',$gender)
                    ->with('legal_status',$legal_status)
                    ->with('marital_status',$marital_status)
                    ->with('state',$state)
                    ->with('city',$city)
                    ->with('country',$country);
    }
  
    public function refferals()
    {
        $data = user::where('referby',Auth::user()->id)->get();
        
        return view('user.refferal')
                    ->with('data',$data);
    }
    public function match_accountnumber_bvn($bvn, $account_no, $bank_id, $fname, $lname)
    {

        $bank = bank::where('id',$bank_id)->first();
        $basic = company::first();
    
        $url = "https://api.paystack.co/bvn/match";
        $fields = [
            "bvn" => $bvn,
            "account_number" => $account_no,
            "bank_code" => $bank->code,
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$basic->paystack_key,
            "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);

        return $result;
    
    }

    public function kycverify(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $basic = company::first();

        if($basic->go_live == 1)
        {
            $bvn = json_decode($this->match_accountnumber_bvn($request->bvn, $request->account_no,$request->bank_id,$request->fname,$request->lname));
        
            if($bvn->status)
            {
                $photoimg = ImageUploadingHelper::upload_image("images/users/",$request->photo_img,$request);
                $licenseimg = ImageUploadingHelper::upload_image("documents/",$request->licence_img,$request);
                $passportimg = ImageUploadingHelper::upload_image("documents/",$request->passport_img,$request);
                $national_front_img = ImageUploadingHelper::upload_image("documents/",$request->national_id_front_img,$request);
                $national_back_img = ImageUploadingHelper::upload_image("documents/",$request->national_id_back_img,$request);


                    

                $user->name = $request->fname .' '.$request->lname;
                $user->lname = $request->lname;
                $user->fname = $request->fname ;
                $user->bank_id = $request->bank_id ;
                $user->account_no = $request->account_no ;
                $user->accountname = $request->accountname ;
                $user->bvn = $request->bvn ;
                $user->dob = $request->dob ;
                $user->gender = $request->gender_id;
                $user->address = $request->address;
                $user->bvn_verify = 1;
                $user->city = $request->city_id ;
                $user->state = $request->state_id;
                $user->country = $request->country_id;
                $user->current_salary = $request->current_salary;
                $user->current_work = $request->current_work;
                $user->user_img =  isset($photoimg) ? $photoimg : $user->user_img;
                $user->save();

                $date = date("Y-m-d h:m:s");
                if($licenseimg != "" || $licenseimg != null)
                {
                    $licence = new verification();

                    $licence->user_id = $user_id;
                    $licence->type = 3;
                    $licence->image1 = $licenseimg;
                    $licence->image2 = "";
                    $licence->number = "";
                    $licence->date = $date;
                    $licence->status = 1;
                    $licence->created_at = $date;
                    $licence->updated_at = $date;

                    $licence->save();
                }
                if($passportimg != "" || $passportimg != null)
                {
                    $passport = new verification();

                    $passport->user_id = $user_id;
                    $passport->type = 2;
                    $passport->image1 = $passportimg;
                    $passport->image2 = "";
                    $passport->number = "";
                    $passport->date = $date;
                    $passport->status = 1;
                    $passport->created_at = $date;
                    $passport->updated_at = $date;

                    $passport->save();
                }

                if($national_front_img != "")
                {
                    
                    $national = new verification();

                    $national->user_id = $user_id;
                    $national->type = 1;
                    $national->image1 = $national_front_img;
                    $national->image2 = $national_back_img;
                    $national->number = "";
                    $national->date = $date;
                    $national->status = 1;
                    $national->created_at = $date;
                    $national->updated_at = $date;

                    $national->save();
                }


                session()->flash('success', 'Your KYC has been submitted successfully');
                return redirect()->route('user.home');
            }
            else
            {
                session()->flash('warning', 'Your BVN is incorrect');
                return back();
            }
        }
        else
        {
                $photoimg = ImageUploadingHelper::upload_image("images/users/",$request->photo_img,$request);
                $licenseimg = ImageUploadingHelper::upload_image("documents/",$request->licence_img,$request);
                $passportimg = ImageUploadingHelper::upload_image("documents/",$request->passport_img,$request);
                $national_front_img = ImageUploadingHelper::upload_image("documents/",$request->national_id_front_img,$request);
                $national_back_img = ImageUploadingHelper::upload_image("documents/",$request->national_id_back_img,$request);


                    

                $user->name = $request->fname .' '.$request->lname;
                $user->lname = $request->lname;
                $user->fname = $request->fname ;
                $user->bank_id = $request->bank_id ;
                $user->account_no = $request->account_no ;
                $user->accountname = $request->accountname ;
                $user->bvn = $request->bvn ;
                $user->dob = $request->dob ;
                $user->gender = $request->gender_id;
                $user->address = $request->address;
                $user->bvn_verify = 1;
                $user->city = $request->city_id ;
                $user->state = $request->state_id;
                $user->country = $request->country_id;
                $user->current_salary = $request->current_salary;
                $user->current_work = $request->current_work;
                $user->user_img =  isset($photoimg) ? $photoimg : $user->user_img;
               

                $user->save();

                $date = date("Y-m-d h:m:s");
                
                if($licenseimg != "" || $licenseimg != null)
                {
                    $licence = new verification();

                    $licence->user_id = $user_id;
                    $licence->type = 3;
                    $licence->image1 = $licenseimg;
                    $licence->image2 = "";
                    $licence->number = "";
                    $licence->date = $date;
                    $licence->status = 1;
                    $licence->created_at = $date;
                    $licence->updated_at = $date;

                    $licence->save();
                }
                if($passportimg != "" || $passportimg != null)
                {
                    $passport = new verification();

                    $passport->user_id = $user_id;
                    $passport->type = 2;
                    $passport->image1 = $passportimg;
                    $passport->image2 = "";
                    $passport->number = "";
                    $passport->date = $date;
                    $passport->status = 1;
                    $passport->created_at = $date;
                    $passport->updated_at = $date;

                    $passport->save();
                }

                if($national_front_img != "")
                {
                    
                    $national = new verification();

                    $national->user_id = $user_id;
                    $national->type = 1;
                    $national->image1 = $national_front_img;
                    $national->image2 = $national_back_img;
                    $national->number = "";
                    $national->date = $date;
                    $national->status = 1;
                    $national->created_at = $date;
                    $national->updated_at = $date;

                    $national->save();
                }


                session()->flash('success', 'Your KYC has been submitted successfully');
                return redirect()->route('user.home');
        }
    }

    
    public function sendemailcode(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $basic = company::first();
        $code = strtoupper(Str::random(6));
        $user->email_time = Carbon::now();
        $user->email_code = $code;
        $user->save();

        if($basic->go_live == 1)
        {
            $user = User::find(Auth::user()->id);
            Mail::to($user->email)->send(new VerificationCodeMail($user));
        }

        session()->flash('success', 'Email verification code was sent successfully');
        
        return back();
    }

    
    public function emailverify(Request $request)
    {

        $a = $request->email_code;
 
        $user = User::find(Auth::user()->id);

        if ($user->email_code == $a) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your email has been verified successfully');
            return redirect()->route('user.home');
        } else {
            session()->flash('danger', 'Email Verification Code Does not matched');
        }
        return back();
    }

    public function phoneverify(Request $request)
    {

        $a = $request->phone_code;
 
        $user = User::find(Auth::user()->id);

        if ($user->phone_code == $a) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your phone number has been verified successfully');
            return redirect()->route('user.home');
        } else {
            session()->flash('danger', 'Phone Number Verification Code Does not matched');
        }
        return back();
    }


    function send_message( $post_body, $url, $username, $password) {
        $ch = curl_init( );
        $headers = array(
        'Content-Type:application/json',
        'Authorization:Basic '. base64_encode("$username:$password")
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
        // Allow cUrl functions 20 seconds to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
        // Wait 10 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
        $output = array();
        $output['server_response'] = curl_exec( $ch );
        $curl_info = curl_getinfo( $ch );
        $output['http_status'] = $curl_info[ 'http_code' ];
        $output['error'] = curl_error($ch);
        curl_close( $ch );
        return $output;
      } 
}
