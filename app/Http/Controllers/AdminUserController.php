<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\admin;
use App\Models\role;
use App\Models\role_priviledge;
use App\Helpers\GeneralHelper;


use Validator;
use Flash;
use DB;
use File;
use auth;

class AdminUserController extends Controller
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
         $data = admin::join('roles as r', 'r.id','=','admins.roleid')
                    ->select('admins.*','r.name as rolename')
                    ->get();
        

        return view('adminusers.index')
                    ->with('data',$data);
    }
    
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = role::get();
        return view('adminusers.create')
                ->with('role',$role);    
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
            if(DB::table('admins')->where('username',request('username'))->Orwhere('email',request('email'))->exists() == false)
                {
                    
                    $record = new admin();
                    
                    $record->name = request('name');
                    $record->roleid = request('roleid');
                    $record->username = request('username');
                    $record->email = request('email');
                    $record->phonenumber = request('phonenumber');
                    $record->password = bcrypt(request('password'));
                    $record->ref = encrypt(request('password'));
                    $record->remember_token = bcrypt(request('password'));
                    $record->created_at = $date;
                    $record->updated_at = $date;
                   
                    

                    $record->save();
                    
                    Flash::success('Admin User was created successfully.');
                    GeneralHelper::audit_admin_trail("Create new admin user with id:" . $record->id,Auth::user()->id,Auth::user()->name);
                    return redirect(route('adminusers.index'));
                    
                }
                else
                {
                    Flash::error('Already existed admin user.');
                    return redirect(route('adminusers.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New Admin User.');
                return redirect()->route('adminusers.index');
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
        $data = admin::findOrFail($id);
        $role = role::get();
                                
        return view('adminusers.edit')
                ->with('role',$role)
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
        
        $record = admin::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                
            
            if($request->input('password') != "")
            {
                $password = bcrypt($request->input('password'));
                $ref = encrypt($request->input('password'));
            }
            else{

                $password = $user->password;
                $ref = $user->ref;
            }

            $record->name = request('name');

            if(Auth::user()->roleid == 1)
            {
                $record->roleid = request('roleid');
            }

            $record->password = $password;
            $record->ref = $ref;
            $record->roleid = request('roleid');
            $record->phonenumber = request('phonenumber');
            $record->remember_token = $password;
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('Admin User was editted successfully.');
            GeneralHelper::audit_admin_trail("editted admin user with id:" . $record->id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('adminusers.index');
        }
        else
        {
            Flash::warning('No Permission to Edit Admin User.');
            return redirect()->route('adminusers.index');
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
        $user = admin::findorfail($id);
        $delete = role_priviledge::getPriviledge(3);

        if($delete == "1")
        {
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
           
            Flash::success('Admin User was blocked or Unblocked successfully.');
            GeneralHelper::audit_admin_trail("deactivating admin user with id:" . $user->id,Auth::user()->id,Auth::user()->name);
            return redirect()->route('adminusers.index');
        }
        else
        {
            Flash::warning('You dont have permission blocked or unblocked admin user.');
            return redirect()->route('adminusers.index');
        }
    }
}