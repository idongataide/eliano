<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\city;
use App\Models\state;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class CityController extends Controller
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
         $data = city::join('states as s', 's.id','=','cities.state_id')
                    ->select('cities.*','s.name as statename')
                    ->get();
        

        return view('managecity.index')
                    ->with('data',$data);
    }
    
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = state::get();
        return view('managecity.create')
                ->with('state',$state);    
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
            if(DB::table('cities')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new city();
                    
                    $record->name = request('name');
                    $record->state_id = request('state_id');
                    $record->sort_order = request('sort_order');
                    $record->created_at = $date;
                    $record->updated_at = $date;
                   
                    

                    $record->save();
                    
                    Flash::success('city was created successfully.');
                    return redirect(route('managecity.index'));
                    
                }
                else
                {
                    Flash::error('Already existed city.');
                    return redirect(route('managecity.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New city.');
                return redirect()->route('managecity.index');
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
        $data = city::findOrFail($id);
        $state = state::get();
                                
        return view('managecity.edit')
                ->with('state',$state)
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
        
        $record = city::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->state_id = request('state_id');
            $record->sort_order = request('sort_order');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('city was editted successfully.');
            return redirect()->route('managecity.index');
        }
        else
        {
            Flash::warning('No Permission to Edit city.');
            return redirect()->route('managecity.index');
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
            $record = city::findOrFail($id);
            $record->delete();
           
            Flash::success('city was deleted successfully.');
            return redirect()->route('managecity.index');
        }
        else
        {
            Flash::warning('You dont have permission delete city.');
            return redirect()->route('managecity.index');
        }
    }
}