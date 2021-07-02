<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\faq;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class FaqController extends Controller
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
        $data = faq::join('admins', 'admins.id','=','faqs.user_id')
                            ->select('faqs.*','admins.name as username')
                            ->get();
        

        return view('faq.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('faq.create');    
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
            if(DB::table('faqs')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new faq();
                    
                    $record->name = request('name');
                    $record->description = request('description');
                    $record->created_at = $date;
                    $record->updated_at = $date;
                    $record->user_id = Auth::user()->id;
                    

                    $record->save();
                    
                    Flash::success('FAQ was created successfully.');
                    return redirect(route('faq.index'));
                    
                }
                else
                {
                    Flash::error('Already existed FAQ.');
                    return redirect(route('faq.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New FAQ.');
                return redirect()->route('faq.index');
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
        $data = faq::findOrFail($id);
        $users = user::pluck('name','id');
                        
        return view('faq.edit')
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
        
        $record = faq::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->description = request('description');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('FAQ was editted successfully.');
            return redirect()->route('faq.index');
        }
        else
        {
            Flash::warning('No Permission to Edit FAQ.');
            return redirect()->route('faq.index');
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
            $record = faq::findOrFail($id);
            $record->delete();
           
            Flash::success('FAQ was deleted successfully.');
            return redirect()->route('faq.index');
        }
        else
        {
            Flash::warning('You dont have permission delete FAQ.');
            return redirect()->route('faq.index');
        }
    }
}