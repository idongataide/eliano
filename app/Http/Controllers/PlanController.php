<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_interest_method_type;
use App\Models\loan_period_type;
use App\Models\loan_repayment_type;
use App\Models\role_priviledge;
use App\Models\charge_type;
use App\Models\charge_option;
use App\Models\plan;
use App\Models\plan_charge;
use App\Models\user;
use App\Models\charge;
use App\Helpers\GeneralHelper;

use Validator;
use Flash;
use DB;
use File;
use auth;

class planController extends Controller
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
        $data = plan::get();
        

        return view('manageplan.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manageplan.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
           $create = role_priviledge::getPriviledge(1);
           $publish = role_priviledge::getPriviledge(4);


           $id = 0;

           if($create == '1')
           {
                
           
            $id = 0;
            $date = date("Y-m-d h:m:s");
            if(DB::table('plans')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new plan();

                                        
                    $record->name = request('name');
                    $record->duration = request('duration');
                    $record->mininum_loan_amount = request('mininum_loan_amount');
                    $record->contribution_amount	 = request('contribution_amount');
                    
                    $record->created_at = $date;
                    $record->updated_at = $date;
                    $record->user_id = Auth::user()->id;
                    

                    $record->save();
                    
                    Flash::success('Contribution Plan was created successfully.');
                    GeneralHelper::audit_admin_trail("Create new contribution plan with id:" . $record->id,Auth::user()->id,Auth::user()->name);
                    return redirect(route('manageplan.index'));
                    
                }
                else
                {
                    Flash::error('Already existed Contribution Plan.');
                    return redirect(route('manageplan.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New Contribution Plan.');
                return redirect()->route('manageplan.index');
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
        $data = plan::findOrFail($id);
        $users = user::pluck('name','id');
        

                        
        return view('manageplan.edit')
             ->with('users',$users)
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

              
        $record = plan::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                                       
            $record->name = request('name');
            $record->duration = request('duration');
            $record->mininum_loan_amount = request('mininum_loan_amount');
            $record->contribution_amount	 = request('contribution_amount');
            
            $record->updated_at = $date;
            $record->user_id = Auth::user()->id;
                        
            $record->save();

                   
            Flash::success('Contribution Plan was editted successfully.');
            GeneralHelper::audit_admin_trail("Updated Contribution plan with id:" . $record->id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('manageplan.index');
        }
        else
        {
            Flash::warning('No Permission to Edit Contribution Plan.');
            return redirect()->route('manageplan.index');
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
        $delete = role_priviledge::getPriviledge(3);

        if($delete == "1")
        {
            $plan = plan::findorfail($id);
            $status = 0;
            if($plan->status == 1)
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            $plan->status = $status;
            $plan->save();
            
            Flash::success('Contribution Plan was deactivated or activated successfully.');
            GeneralHelper::audit_admin_trail("Deactivated Contribution plan with id:" . $plan->id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('manageplan.index');
        }
        else
        {
            Flash::warning('You dont have permission deactivated or activated Contribution Plan.');
            return redirect()->route('manageplan.index');
        }
    }
}