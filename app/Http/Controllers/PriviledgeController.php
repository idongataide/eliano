<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\artist;
use App\Models\role_priviledge;
use App\Models\priviledge;
use App\Models\role;
use App\Models\user;
use Validator;
use Flash;
use DB;
use File;
use auth;

class PriviledgeController extends Controller
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
        $data = DB::table('role_priviledges as rp')
                        ->join('roles as r','rp.role_id','=','r.id' )
                        ->join('priviledges as p','rp.priviledge_id','=','p.id')
                        ->select('rp.id','r.name as role_name','p.name as priviledge_name')
                        ->orderBy('rp.id','asc')
                        ->get();
                

        return view('priviledge.index')
              ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $roles = role::pluck('name','id');
        $priviledges = priviledge::pluck('name','id');
        
        return view('priviledge.create')
                ->with('roles',$roles)
                ->with('priviledges',$priviledges);
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
           
           if($create == '1')
           {
                if(DB::table('role_priviledges')->where('priviledge_id',request('priviledge_id'))->where('role_id',request('role_id'))->exists() == false)
                {
                    DB::table('role_priviledges')->insert(
                        [
                            'role_id'=>request('role_id'), 
                            'priviledge_id'=>request('priviledge_id')
                        ]
                    );
                    
                    Flash::success('Priviledge was created successfully.');
                    return redirect()->route('priviledge.index');
                }
                else
                {
                    Flash::error('Already existed.');
                    return redirect(route('priviledge.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New Priviledge.');
                return redirect()->route('priviledge.index');
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
            $role_priviledge = role_priviledge::findOrFail($id);
            
            $role_priviledge->delete();
            Flash::success('Priviledge was deleted successfully.');
            return redirect()->route('priviledge.index');
        }
        else
        {
            Flash::warning('You dont have permission delete Priviledges.');
            return redirect()->route('priviledge.index');
        }
    }
}