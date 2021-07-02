<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\state;
use App\Models\country;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class StateController extends Controller
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
         $data = state::join('countries as c', 'c.id','=','states.country_id')
                    ->select('states.*','c.name as country')
                    ->get();
        

        return view('managestate.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = country::get();
        return view('managestate.create')
                ->with('country',$country);    
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
            if(DB::table('states')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new state();
                    
                    $record->name = request('name');
                    $record->country_id = request('country_id');
                    $record->sort_order = request('sort_order');
                    $record->created_at = $date;
                    $record->updated_at = $date;
                   
                    

                    $record->save();
                    
                    Flash::success('State was created successfully.');
                    return redirect(route('managestate.index'));
                    
                }
                else
                {
                    Flash::error('Already existed state.');
                    return redirect(route('managestate.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New state.');
                return redirect()->route('managestate.index');
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
        $data = state::findOrFail($id);
        $country = country::get();
                                
        return view('managestate.edit')
                ->with('country',$country)
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
        
        $record = state::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->country_id = request('country_id');
            $record->sort_order = request('sort_order');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('state was editted successfully.');
            return redirect()->route('managestate.index');
        }
        else
        {
            Flash::warning('No Permission to Edit state.');
            return redirect()->route('managestate.index');
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
            $record = state::findOrFail($id);
            $record->delete();
           
            Flash::success('state was deleted successfully.');
            return redirect()->route('managestate.index');
        }
        else
        {
            Flash::warning('You dont have permission delete state.');
            return redirect()->route('managestate.index');
        }
    }
}