<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_repayment_method;
use App\Helpers\ImageUploadingHelper;
use App\Models\payment_method;
use App\Models\contribution;
use App\Models\company;
use App\Models\user;
use App\Models\bank;
use App\Helpers\SmsHelper;
use App\Models\role_priviledge;
use App\Helpers\GeneralHelper;
use Carbon\Carbon;



use Validator;
use Flash;
use DB;
use File;
use auth;

class ContributionController extends Controller
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
        $start_date = Carbon::now()->startOfMonth()->format('Y-m-d'); 
        $end_date = Carbon::now()->format('Y-m-d');
        
        $data = contribution::whereBetween('payment_date',[$start_date,$end_date])->orderby('id','desc')->get();

        $total = contribution::whereBetween('payment_date',[$start_date,$end_date])->orderby('id','desc')->sum('amount');

                                   
        return view('contributions.index')
                    ->with('start_date',$start_date)
                    ->with('end_date',$end_date)
                    ->with('total',$total)
                    ->with('data',$data);
    }
    public function viewcontribution(Request $request)
    {
        $start_date = request('start_date'); 
        $end_date = request('end_date'); 
        
        $data = contribution::whereBetween('payment_date',[$start_date,$end_date])->orderby('id','desc')->get();

        $total = contribution::whereBetween('payment_date',[$start_date,$end_date])->orderby('id','desc')->sum('amount');

                                   
        return view('contributions.index')
                    ->with('start_date',$start_date)
                    ->with('end_date',$end_date)
                    ->with('total',$total)
                    ->with('data',$data);
    }
    public function getcontributionledger()
    {
        
        $start_date = Carbon::now()->startOfMonth()->format('Y-m-d'); 
        $end_date = Carbon::now()->format('Y-m-d');
       

            
        session(['start_date' => $start_date, 'end_date'=>$end_date]);
        
        
        $data['ledger'] = DB::table('contributions as c')
                        ->join('users as u','c.member_id','=','u.reg_no')
                        ->join('banks as b','c.bank_id','=','b.id')
                        ->select('c.remark','c.payment_date','c.amount','u.name as name','u.reg_no as registration_no','u.plan_name as plan')
                        ->whereBetween('c.payment_date',[$start_date,$end_date])
                        ->where('c.status',2)
                        ->orderBy('c.id','asc')
                        ->get();                    
     

        $json_data = $data['ledger']->toJson();
        return view('contributions.ledger')
                ->with('data',$json_data)
                ->with('start_date',$start_date)
                ->with('end_date',$end_date);   
    }

    public function postcontributionledger()
    {
        
        $start_date = request('start_date'); 
        $end_date = request('end_date');
       
            
        session(['start_date' => $start_date, 'end_date'=>$end_date]);
        
        
        $data['ledger'] = DB::table('contributions as c')
                        ->join('users as u','c.member_id','=','u.reg_no')
                        ->join('banks as b','c.bank_id','=','b.id')
                        ->select('c.remark','c.payment_date','c.amount','u.name as name','u.reg_no as registration_no','u.plan_name as plan')
                        ->whereBetween('c.payment_date',[$start_date,$end_date])
                        ->where('c.status',2)
                        ->orderBy('c.id','asc')
                        ->get();                   
     

        $json_data = $data['ledger']->toJson();
        return view('contributions.ledger')
                ->with('data',$json_data)
                ->with('start_date',$start_date)
                ->with('end_date',$end_date);   
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentmethod = loan_repayment_method::get();
        $bank = bank::orderby('name','asc')->get();
        $user = user::where('roleid',4)->orderby('name','asc')->get();

         return view('contributions.create')
                ->with('paymentmethod',$paymentmethod)
                ->with('bank',$bank)
                ->with('user',$user);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                   
        $date = date("Y-m-d h:m:s");
        $merchant = user::where('referby',$request->contributor_id)->first();
        $user = user::where('id',$request->contributor_id)->first();
        $basic=company::find(1);

        $merchant_id = "";

        if($merchant == "" || $merchant == null)
        {
            $merchant_id = "";
        }
        else
        {
            $merchant_id = $merchant->id;
        }

        $create = role_priviledge::getPriviledge(1);
        $publish = role_priviledge::getPriviledge(4);

        if($create == '1')
        {
            $record = new contribution();

            $record->contributor_id = $request->contributor_id;
            $record->user_id =Auth::user()->id;
            $record->bank_id = request('bank_id');
            $record->payment_date = request('payment_date');
            $record->merchant_id = $merchant_id;
            $record->member_id = $user->reg_no;
            $record->amount = request('amount');
            $record->payment_method_id = request('payment_method_id');
            $record->remark = request('remark');
            $record->sms = 2;
            $record->status = 2;
            $record->created_at = $date;
            $record->updated_at = $date;
                                
            $record->save();


            $message = "Your " . request('amount') . " ". $user->plan_name . " contribution with ". $basic->sms_sender." was successful";
            if($basic->go_live == 1)
            {
                SmsHelper::smsv2($user->phonenumber,$message);
            }
                    
            Flash::success('Contribution was posted successfully.');
            GeneralHelper::audit_admin_trail("contribution was posted successfully with id:" . $record->id,Auth::user()->id,Auth::user()->name);
            return redirect(route('contributions.index'));
        }
        else
        {
            Flash::warning('No Permission to post contribution.');
            GeneralHelper::audit_admin_trail("Attempt to post contribution",Auth::user()->id,Auth::user()->name);
            return redirect()->route('contributions.index');
        }
                    
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
        $data = contribution::findOrFail($id);
        $paymentmethod = loan_repayment_method::get();
        $bank = bank::orderby('name','asc')->get();
        $user = user::where('roleid',4)->orderby('name','asc')->get();

                                
        return view('contributions.edit')
                ->with('bank',$bank)
                ->with('paymentmethod',$paymentmethod)
                ->with('user',$user)
                ->with(compact('data'));
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
        $date = date("Y-m-d h:m:s");
        $edit = role_priviledge::getPriviledge(2);
        $publish = role_priviledge::getPriviledge(4);
        $basic = company::first();
        
        $merchant = user::where('referby',$request->contributor_id)->first();
        $user = user::where('id',$request->contributor_id)->first();
        $merchant_id = "";

        if($merchant == "" || $merchant == null)
        {
            $merchant_id = "";
        }
        else
        {
            $merchant_id = $merchant->id;
        }

        $record = contribution::findorfail($id);
        if($edit == '1')
        {
            $record->contributor_id = $request->contributor_id;
            $record->last_updated_user_id = Auth::user()->id;
            $record->bank_id = request('bank_id');
            $record->payment_date = request('payment_date');
            $record->merchant_id = $merchant_id;
            $record->member_id = $user->reg_no;
            $record->amount = request('amount');
            $record->payment_method_id = request('payment_method_id');
            $record->remark = request('remark');
            $record->updated_at = $date;
                                
            $record->save();

                               
            Flash::success('payment was updated successfully.');
            GeneralHelper::audit_admin_trail("contribution was editted successfully with id:" . $record->id,Auth::user()->id,Auth::user()->name);
            return redirect(route('contributions.index'));
        }
        else
        {
            Flash::warning('No Permission to edit contribution.');
            GeneralHelper::audit_admin_trail("Attempt to edit contribution fail because of priviledge with id: ".$id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('contributions.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = contribution::findOrFail($id);
        $delete = role_priviledge::getPriviledge(3);

        if($delete == "1")
        {  
            $record->status = "3";
            $record->save();
            
            Flash::success('Contribution was deleted successfully.');
            GeneralHelper::audit_admin_trail("Contribution was deleted with id: " . $record->id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('contributions.index');
        }
        else
        {
            Flash::warning('No Permission to delete contribution.');
            GeneralHelper::audit_admin_trail("Attempt to delete contribution fails with id: ".$id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('contributions.index');
        }
    }
}