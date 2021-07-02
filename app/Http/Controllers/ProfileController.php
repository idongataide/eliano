<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use DB;
use Hash;


class ProfileController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $profile = user::findorfail($id);

        return view('manageprofile.edit')
                ->with('profile',$profile);
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
        $oldpassword = request('oldpassword');
        $password = request('password');
        $confirm_password = request('password_confirmation');
        $user_id = Auth::user()->id;
        

        if($password != ""){
        
            if($password != $confirm_password)
            {
                Flash::error('New Password does not match with confirmed password!');
                return redirect(route('manageprofile.edit',[$user_id]));
            }

            if(Auth::user()->ref != "")
            {
                $old_ref = decrypt(Auth::user()->ref);
                if(!($old_ref == $oldpassword))
                {
                    Flash::error('Old Password does not match!');
                    return redirect(route('manageprofile.edit',[$user_id]));
                }
            }

            $password = bcrypt($request->input('password'));
            $ref = encrypt($request->input('password'));

            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(array('password'=>$password,'ref'=>$ref));
      }
        
         $record = user::findorfail($id);
       
        $record->lname = request('lname');
        $record->fname = request('fname');
        $record->email = request('email');
        $record->phonenumber = request('phonenumber');
        $record->name = request('fname') . ' ' . request('lname');

        $record->save();


        Flash::success('Your Profile was saved successfully!.');
        return redirect(route('manageprofile.edit',[$user_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
