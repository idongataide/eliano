<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\bank;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class BankController extends Controller
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
        $data = bank::get();
                            

        return view('managebank.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('managebank.create');    
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
            if(DB::table('banks')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new bank();
                    
                    $record->name = request('name');
                    $record->code = request('code');
                    $record->created_at = $date;
                    $record->updated_at = $date;
                                        

                    $record->save();
                    
                    Flash::success('bank was created successfully.');
                    return redirect(route('managebank.index'));
                    
                }
                else
                {
                    Flash::error('Already existed bank.');
                    return redirect(route('managebank.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New bank.');
                return redirect()->route('managebank.index');
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
        $data = bank::findOrFail($id);
                                
        return view('managebank.edit')
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
        
        $record = bank::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->code = request('code');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('bank was editted successfully.');
            return redirect()->route('managebank.index');
        }
        else
        {
            Flash::warning('No Permission to Edit bank.');
            return redirect()->route('managebank.index');
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
            $record = bank::findOrFail($id);
            $record->delete();
           
            Flash::success('bank was deleted successfully.');
            return redirect()->route('managebank.index');
        }
        else
        {
            Flash::warning('You dont have permission delete bank.');
            return redirect()->route('managebank.index');
        }
    }
}