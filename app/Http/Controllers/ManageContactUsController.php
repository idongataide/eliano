<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\contactus;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class ManageContactUsController extends Controller
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
        $data = contactus::orderBy('id', 'desc')->get();
        

        return view('managecontactus.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('managecontactus.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
           
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
        $data = contactus::findOrFail($id);
        
                        
        return view('managecontactus.edit')
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
        
        $record = contactus::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->remark = request('remark');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('contactus was editted successfully.');
            return redirect()->route('managecontactus.index');
        }
        else
        {
            Flash::warning('No Permission to Edit contactus message.');
            return redirect()->route('managecontactus.index');
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
            $record = contactus::findOrFail($id);
            $record->delete();
           
            Flash::success('ontactus was deleted successfully.');
            return redirect()->route('managecontactus.index');
        }
        else
        {
            Flash::warning('You dont have permission delete contactus.');
            return redirect()->route('managecontactus.index');
        }
    }
}