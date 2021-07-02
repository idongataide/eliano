<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\city;
use App\Models\faq;
use App\Models\contactus;
use App\Models\state;
use App\Helpers\ImageUploadingHelper;
use Illuminate\Support\Facades\Storage;
use App\Models\user;
use DB;
use App\Models\loan_product;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function register($reference)
    {
        $page_title = "register";
        
        $exist = user::where('username', $reference)->count();

        if($exist > 0){
        session()->flash('ref', 'You are about to register using '.$reference.' as your sponsor. You can Also Share Your Referral Link To Earn Bonus When He apply for loan and repay promptly.');
        return view('auth.register',compact('reference','page_title')); }

        else {
        session()->flash('refferor', 'No user with this referral link. Please check and try again later');
        return redirect()->route('home');
        }
    }


    public function getCity($state_id=0){

        // Fetch city by stateid
        $data['data'] = city::where('state_id', $state_id)->orderby('name')->get();
        $json_data = $data['data']->toJson();
        echo $json_data;
        exit;
    }

    public function getState($country_id=0){

        // Fetch state by country id
        $data['data'] = state::where('country_id', $country_id)->orderby('name')->get();
        $json_data = $data['data']->toJson();
        echo $json_data;
        exit;
    }

    public function interestrate($product_id=0){

        // Fetch state by country id
        $data = loan_product::where('id', $product_id)->first();
        if (!empty($data)) {
            $json_data = $data->interest_rate;
            echo $json_data;
            exit;
        }
        else
        {
            echo 0;
            exit; 
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactus()
    {
        return view('contact-us');
    }

    public function faq()
    {
        $faq = faq::get();
        return view('faqs')
        ->with('faq',$faq);
    }

    public function aboutus()
    {
        return view('about-us');
    }

    public function testimonial()
    {
        return view('testimonial');
    }

    public function policy()
    {
        return view('policy');
    }

    public function tc()
    {
        return view('tc');
    }
   
    public function updateContactus(Request $request)
    {
        //dd($request->name);
        
        $date = date("Y-m-d h:m:s");
        $record = new contactus();

        $record->name = $request->name;
        $record->email = $request->email;
        $record->message = $request->message;
        $record->created_at = $date;

        $record->save();
                    

        return redirect()->back()->with('success','Your Message was sent successfully');
    }
 }
