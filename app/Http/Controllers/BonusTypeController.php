<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\bonuscategory;
use App\Models\bonustype;
use App\Models\role_priviledge;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class BonusTypeController extends Controller
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
         $data = bonustype::get();
        

        return view('managebonustype.index')
                    ->with('data',$data);
    }
    
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        $data = bonustype::findOrFail($id);
        $category = bonuscategory::get();
                                
        return view('managebonustype.edit')
                ->with('category',$category)
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
        
        $record = bonustype::findOrFail($id);
        
       
        
        if($edit == '1')
        {
                                            
            $record->name = request('name');
            $record->category = request('category');
            $record->amount = request('amount');
            $record->updated_at = $date;
            

            $record->save();
        
            Flash::success('Bonus type was editted successfully.');
            return redirect()->route('managebonustype.index');
        }
        else
        {
            Flash::warning('No Permission to Edit Bonus Type.');
            return redirect()->route('managebonustype.index');
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
       
    }
}