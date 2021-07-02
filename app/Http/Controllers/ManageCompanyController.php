<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\role_priviledge;
use App\Helpers\ImageUploadingHelper;
use App\Helpers\SmsHelper;
use App\Models\user;
use App\Models\company;
use App\Models\status;


use Validator;
use Flash;
use DB;
use File;
use auth;

class ManageCompanyController extends Controller
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $company = company::findorfail($id);

    
        return view('managecompany.edit')
              ->with('company',$company);    
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
        $record = company::findorfail($id);
        $date = date("Y-m-d h:m:s");

        $admin_image = ImageUploadingHelper::upload_image("images/",request('admin_image'),$request);
        $favicon = ImageUploadingHelper::upload_image("images/",request('favicon'),$request);
        $aboutus_image = ImageUploadingHelper::upload_image("images/",request('aboutus_image'),$request);

        $record->name = request('name');
        $record->address = request('address');
        $record->city = request('city');
        $record->phone = request('phone');
        $record->email = request('email');
        $record->name_prefix = request('name_prefix');
        $record->created_at = $date;
        $record->facebook = request('facebook');
        $record->twitter = request('twitter');
        $record->youtube = request('youtube');
        $record->instagram = request('instagram');

        $record->email_verification = isset($request->email_verification) ? '1':'0';
        $record->bvn_verification = isset($request->bvn_verification) ? '1':'0';
        $record->phone_verification = isset($request->phone_verification) ? '1':'0';
        $record->kyc_verification = isset($request->kyc_verification) ? '1':'0';

       
        $record->website = request('website');
        $record->paystack_key = request('paystack_key');
        $record->currency_sym = request('currency_sym');

        $record->contact_page = request('contact_page');
        $record->about_page = request('about_page');
        $record->faq_page = request('faq_page');
        
        $record->aboutus = request('aboutus');
        
        $record->favicon = isset($favicon) ? $favicon : $record->favicon;
        $record->site_image =isset($admin_image) ? $admin_image : $record->site_image;
        $record->aboutus_image = isset($aboutus_image) ? $aboutus_image : $record->aboutus_image;

        
        $record->sms_api = request('sms_api');
        $record->sms_sender = request('sms_sender');
        $record->contributor_code_prefix = request('contributor_code_prefix');
        $record->merchant_code_prefix = request('merchant_code_prefix');
        

       
        
        $record->save();
           
        Flash::success('Setting was saved successfully');
        return redirect(route('managecompany.edit',[1]));

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