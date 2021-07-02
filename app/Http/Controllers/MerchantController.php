<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\user;
use App\Models\role_priviledge;
use App\Helpers\ImageUploadingHelper;
use App\Helpers\GeneralHelper;
use App\Models\verification;
use App\Models\bank;
use App\Models\marital_status;
use App\Models\company;
use App\Models\gender;
use App\Models\city;
use App\Models\state;
use App\Models\country;
use App\Models\legal_status;
use App\Models\plan;
use File;
use auth;
use validator;


class MerchantController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  
    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = user::where('roleid','5')->orderBy('id', 'asc')->get();
      
        return view('merchant.index')
               ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $legal_status = legal_status::get();
        $gender = gender::get();
        $marital_status = marital_status::get();
        $country = country::get();
        $state = state::get();
        $city = city::get();
        $bank = bank::get();

        return view('merchant.create')
             ->with('marital_status',$marital_status)
             ->with('gender',$gender)
             ->with('country',$country)
             ->with('city',$city)
             ->with('state',$state)
             ->with('bank',$bank)
             ->with('legal_status',$legal_status);             
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'required|numeric|min:8',
            'username' => 'required|string|min:3|unique:users',
            'password' => 'required|string|min:2',
            'fname' => 'required',
            'lname' => 'required',
        ],
        [
            'phonenumber.required' => 'Phone Number is required!!',
            'email.required' => 'Email Address must not be  empty!!',
            'username.required' => 'username must not be  empty!!',
        ]);
    }

    public function store(Request $request)
    {      
           $create = role_priviledge::getPriviledge(1);
           $publish = role_priviledge::getPriviledge(4);
           $plan = plan::find(1);
           $company = company::find(1);

            $merchant = user::where('email', '=', request('email'))
            ->where('username', '=', request('username'))
            ->where('phonenumber', '=', request('phonenumber'))
            ->where('roleid', '=', '5')
            ->first();

            if ($merchant !== null) {
                Flash::error('Merchant Already Exist');
                return redirect(route('merchant.index'));
            }

           $user_image = ImageUploadingHelper::upload_image("images/users",request('img'),$request);
           $id = 0;

           if($create == '1')
           {
            $date = date("Y-m-d H:i:s");
            $img = "user-thumb-sm.png";
            
            $user = new user();
                        
            $user->name = request('fname') . ' '.request('lname');
            $user->fname = request('fname');
            $user->lname = request('lname');
            $user->email = request('email');
            $user->username = request('username');
            $user->password = bcrypt($request->input('email'));
            $user->ref = encrypt($request->input('email'));
            $user->roleid = 5;
            $user->email_verify = 1;
            $user->phone_verify = 1;
            $user->bvn_verify = 1;
            $user->kyc_verify = 1;
            $user->bank_id = request('bank_id');
            $user->account_no = request('account_no');
            $user->referby = 0;
            $user->accountname = request('accountname');
            $user->bvn = request('bvn');
            $user->dob = request('dob');
            $user->gender = request('gender');
            $user->home_address = request('home_address');
            $user->city = request('city');
            $user->state = request('state');
            $user->country = request('country');
            $user->remember_token = encrypt($request->input('email'));
            $user->phonenumber = request('phonenumber');
            $user->status = 1;
            $user->created_at = $date;
            $user->employer_address = request('employer_address');
            $user->establishment = request('establishment');
            $user->date_of_expiry = request('date_of_expiry');
            $user->date_issued = request('date_issued');
            $user->Identification_number = request('Identification_number');
            $user->type_of_id = request('type_of_id');
            $user->village = request('village');
            $user->legal_status_id = request('legal_status_id');
            $user->business_address = request('business_address');
            $user->marital_status_id = request('marital_status_id');
            $user->pep = isset($request->pep) ? '1':'0';
            $user->regulatory_status = request('regulatory_status');

            $user->kin_name = request('kin_name');
            $user->kin_relationship = request('kin_relationship');
            $user->kin_phone = request('kin_phone');
            $user->kin_email = request('kin_email');
            $user->kin_gender_id = request('kin_gender_id');
            $user->kin_dob = request('kin_dob');
            $user->kin_id_type = request('kin_id_type');
            $user->kin_id_number = request('kin_id_number');
            $user->kin_home_address = request('kin_home_address');
            $user->kin_occupation = request('kin_occupation');
            $user->kin_occupation_address = request('kin_occupation_address');
            $user->gar_name = request('gar_name');
            $user->gar_occupation = request('gar_occupation');
            $user->gar_position = request('gar_position');
            $user->gar_relationship = request('gar_relationship');
            $user->gar_gender = request('gar_gender');
            $user->gar_phone = request('gar_phone');
            $user->gar_address = request('gar_address');
            $user->gar_id_type = request('gar_id_type');
            $user->gar_id_number = request('gar_id_number');
            $user->gar_date_issued = request('gar_date_issued');
            $user->gar_date_expiry = request('gar_date_expiry');
            $user->gar_date_signed = request('gar_date_signed');
            $user->plan_id = $plan->id;
            $user->plan_name = $plan->name;
            $user->plan_contribution_amount = $plan->contribution_amount;
            $user->plan_loan_amount = $plan->mininum_loan_amount;
            $user->plan_duration = $plan->duration;
            $user->updated_at = $date;
            $user->user_img = isset($user_image) ? $user_image : $img;
            $user->save();

            $idcount = user::where('roleid','5')->count();

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
                $reg_no = $company->merchant_code_prefix . "00" . $idcount;
            }
            else if($id_len == 2)
            {
                $reg_no =  $company->merchant_code_prefix . "0". $idcount;
            }
            else
            {
                $reg_no = $company->merchant_code_prefix . $idcount;
            }

            $record = user::findorfail($user->id);
            $record->reg_no = $reg_no;
            $record->save();

            Flash::success('Merchant was created successfully.');
            GeneralHelper::audit_admin_trail("Merchant was created with id:" . $user->id,Auth::user()->id,Auth::user()->name);
            return redirect(route('merchant.index'));
           }
           else
           {
                Flash::warning('No Permission to Create New Merchant.');
                GeneralHelper::audit_admin_trail("Attempt to create new merchant",Auth::user()->id,Auth::user()->name);
                return redirect()->route('merchant.index');
           }
    }


    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = user::findorfail($id);
        $legal_status = legal_status::get();
        $gender = gender::get();
        $marital_status = marital_status::get();
        $country = country::get();
        $state = state::get();
        $city = city::get();
        $bank = bank::get();

    
       if (empty($user)) {
            Flash::error('Merchant not found');
            return redirect(route('merchant.index'));
        }

        return view('merchant.edit')
             ->with('marital_status',$marital_status)
             ->with('gender',$gender)
             ->with('country',$country)
             ->with('city',$city)
             ->with('state',$state)
             ->with('bank',$bank)
             ->with('user',$user)
             ->with('legal_status',$legal_status);   

    }


    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $edit = role_priviledge::getPriviledge(2);
        $publish = role_priviledge::getPriviledge(4);
        $user = user::findorfail($id);
        $company = company::find(1);

        if($edit == '1')
        {
            
            $plan = plan::find(1);
            $img = "user-thumb-sm.png";
            
            if (empty($user)) {
                Flash::error('Merchant not found');

                return redirect(route('merchant.index'));
            }
            $date = date("Y-m-d H:i:s");

            $img = ImageUploadingHelper::upload_image("images/users",request('img'),$request);

            $user->name = request('fname') . ' '.request('lname');
            $user->reg_no = request('reg_no');
            $user->fname = request('fname');
            $user->lname = request('lname');
            $user->email = request('email');
            $user->username = request('username');
            $user->password = bcrypt($request->input('email'));
            $user->ref = encrypt($request->input('email'));
            $user->roleid = 5;
            $user->email_verify = 1;
            $user->phone_verify = 1;
            $user->bvn_verify = 1;
            $user->kyc_verify = 1;
            $user->bank_id = request('bank_id');
            $user->account_no = request('account_no');
            $user->referby = '0';
            $user->accountname = request('accountname');
            $user->bvn = request('bvn');
            $user->dob = request('dob');
            $user->gender = request('gender');
            $user->home_address = request('home_address');
            $user->city = request('city');
            $user->state = request('state');
            $user->country = request('country');
            $user->remember_token = encrypt($request->input('email'));
            $user->phonenumber = request('phonenumber');
            $user->status = 1;
            //$user->created_at = $date;
            $user->employer_address = request('employer_address');
            $user->establishment = request('establishment');
            $user->date_of_expiry = request('date_of_expiry');
            $user->date_issued = request('date_issued');
            $user->Identification_number = request('Identification_number');
            $user->type_of_id = request('type_of_id');
            $user->village = request('village');
            $user->legal_status_id = request('legal_status_id');
            $user->business_address = request('business_address');
            $user->marital_status_id = request('marital_status_id');
            $user->pep = isset($request->pep) ? '1':'0';
            $user->regulatory_status = request('regulatory_status');

            $user->kin_name = request('kin_name');
            $user->kin_relationship = request('kin_relationship');
            $user->kin_phone = request('kin_phone');
            $user->kin_email = request('kin_email');
            $user->kin_gender_id = request('kin_gender_id');
            $user->kin_dob = request('kin_dob');
            $user->kin_id_type = request('kin_id_type');
            $user->kin_id_number = request('kin_id_number');
            $user->kin_home_address = request('kin_home_address');
            $user->kin_occupation = request('kin_occupation');
            $user->kin_occupation_address = request('kin_occupation_address');
            $user->gar_name = request('gar_name');
            $user->gar_occupation = request('gar_occupation');
            $user->gar_position = request('gar_position');
            $user->gar_relationship = request('gar_relationship');
            $user->gar_gender = request('gar_gender');
            $user->gar_phone = request('gar_phone');
            $user->gar_address = request('gar_address');
            $user->gar_id_type = request('gar_id_type');
            $user->gar_id_number = request('gar_id_number');
            $user->gar_date_issued = request('gar_date_issued');
            $user->gar_date_expiry = request('gar_date_expiry');
            $user->gar_date_signed = request('gar_date_signed');
            $user->plan_id = $plan->id;
            $user->plan_name = $plan->name;
            $user->plan_contribution_amount = $plan->contribution_amount;
            $user->plan_loan_amount = $plan->mininum_loan_amount;
            $user->plan_duration = $plan->duration;
            $user->updated_at = $date;

            $user->user_img =isset($img) ? $img : $user->user_img;
            $user->save();


            $idcount = user::where('roleid','5')->count();

            if($idcount == 0)
            {
                $idcount = 1;
            }
            else
            {
                $idcount = $idcount;
            }

            
            if(request('reg_no') == "")
            {
                $id_len =  strlen($idcount);
                
                $reg_no = "";
                
                if($id_len == 1)
                {
                    $reg_no = $company->merchant_code_prefix . "00" . $idcount;
                }
                else if($id_len == 2)
                {
                    $reg_no =  $company->merchant_code_prefix . "0". $idcount;
                }
                else
                {
                    $reg_no = $company->merchant_code_prefix . $idcount;
                }

                $record = user::findorfail($user->id);
                $record->reg_no = $reg_no;
                $record->save();
            }

            Flash::success('Merchant was updated successfully.');
            GeneralHelper::audit_admin_trail("Merchant was updated with id:" . $user->id,Auth::user()->id,Auth::user()->name);
            return redirect(route('merchant.index'));
        }
        else
        {
            Flash::warning('No Permission to Edit Merchant.');
            GeneralHelper::audit_admin_trail("Attempt to edit a merchant",Auth::user()->id,Auth::user()->name);
            return redirect()->route('merchant.index');
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = user::findorfail($id);
        $delete = role_priviledge::getPriviledge(3);

        if($delete == "1")
        {

        if (empty($user)) {
            Flash::error('Merchant not found');

            return redirect(route('merchant.index'));
        }

        $status = 0;
        if($user->status == 1)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $user->status = $status;
        $user->save();

        Flash::success('Merchant has been blocked or unblocked successfully.');
        GeneralHelper::audit_admin_trail("Merchant was deactivated with id:" . $user->id,Auth::user()->id,Auth::user()->name);
        return redirect(route('merchant.index'));
    }
    else
    {
        Flash::warning('No Permission to block a merchant.');
        GeneralHelper::audit_admin_trail("Attempt to block or unblock a merchant",Auth::user()->id,Auth::user()->name);
        return redirect()->route('merchant.index');
    }
    }
}
