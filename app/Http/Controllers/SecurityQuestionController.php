<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\role_priviledge;
use App\Models\user;
use App\Models\security_question;

use Validator;
use Flash;
use DB;
use File;
use auth;

class SecurityQuestionController extends Controller
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
        $data = security_question::join('admins', 'admins.id','=','security_questions.user_id')
                            ->select('security_questions.*','admins.name as username')
                            ->get();
        

        return view('securityquestion.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('securityquestion.create');    
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
            if(DB::table('security_questions')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new security_question();
                    
                    $record->name = request('name');
                    $record->created_at = $date;
                    $record->updated_at = $date;
                    $record->user_id = Auth::user()->id;
                    

                    $record->save();
                    
                    Flash::success('security question was created successfully.');
                    return redirect(route('securityquestion.index'));
                    
                }
                else
                {
                    Flash::error('Already existed security_question.');
                    return redirect(route('securityquestion.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New security question.');
                return redirect()->route('securityquestion.index');
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
        $data = security_question::findOrFail($id);
        $users = user::pluck('name','id');
                        
        return view('securityquestion.edit')
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
        
        $record = security_question::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('security question was editted successfully.');
            return redirect()->route('securityquestion.index');
        }
        else
        {
            Flash::warning('No Permission to Edit security question.');
            return redirect()->route('securityquestion.index');
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
            $record = security_question::findOrFail($id);
            $record->delete();
           
            Flash::success('security question was deleted successfully.');
            return redirect()->route('securityquestion.index');
        }
        else
        {
            Flash::warning('You dont have permission delete security question.');
            return redirect()->route('securityquestion.index');
        }
    }
}