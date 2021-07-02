<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\charge_option;
use App\Models\charge_type;
use App\Models\charge;
use App\Helpers\ImageUploadingHelper;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class ChargeController extends Controller
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
        $data = charge::all();
                                   
        return view('managecharge.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $charge_option = charge_option::get();
        $charge_type = charge_type::get();

              

         return view('managecharge.create')
                ->with('charge_option',$charge_option)
                ->with('charge_type',$charge_type);    
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
                
        $record = new charge();
        
        $record->name = $request->name;
        $record->product = 'loan';
        $record->charge_type = $request->charge_type;
        $record->charge_option = $request->charge_option;
        $record->amount = $request->amount;
        $record->penalty = isset($request->penalty) ? '1':'0';
        $record->override = isset($request->overide) ? '1' : '0';
        $record->active = '1';
        $record->created_at = $date;
        $record->updated_at = $date;
                            
        $record->save();
                
        session()->flash('danger','charge was posted successfully.');
        return redirect(route('managecharge.index'));
                    
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
        $data = charge::findOrFail($id);
        $charge_option = charge_option::get();
        $charge_type = charge_type::get();
       
                                
        return view('managecharge.edit')
                ->with('charge_type',$charge_type)
                ->with('charge_option',$charge_option)
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
                
        $record = charge::findorfail($id);
        
        
        $record->name = $request->name;
        $record->charge_type = request('charge_type');
        $record->charge_option = request('charge_option');
        $record->amount = request('amount');
        $record->penalty = isset($request->penalty) ? '1':'0';
        $record->override = isset($request->overide) ? '1' : '0';
        $record->updated_at = $date;
                            
        $record->save();
                
        session()->flash('success','charge was updated successfully.');
        return redirect(route('managecharge.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = charge::findOrFail($id);
        if($record->active == "1")
        { 
            
            $record->active = "0";
            $record->save();
            
            session()->flash('success','charge was deactivated successfully.');
            return redirect()->route('managecharge.index');
        }
        else
        {
            $record->active = "1";
            $record->save();

            session()->flash('danger','Once charge was activated successfully.');
            return redirect(route('managecharge.index'));
        }
    }
}