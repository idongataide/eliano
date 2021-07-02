<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_product;
use App\Models\loan_interest_method_type;
use App\Models\loan_period_type;
use App\Models\loan_repayment_type;
use App\Models\role_priviledge;
use App\Models\charge_type;
use App\Models\charge_option;
use App\Models\loan_product_charge;
use App\Models\user;
use App\Models\charge;

use Validator;
use Flash;
use DB;
use File;
use auth;

class LoanProductController extends Controller
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
        $data = loan_product::get();
        

        return view('manageloanproduct.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $loan_interest_method_type = loan_interest_method_type::get();
        $loan_period_type = loan_period_type::get();
        $loan_repayment_type = loan_repayment_type::get();
        
               
        
        return view('manageloanproduct.create')
        ->with('loan_interest_method_type',$loan_interest_method_type)
        ->with('loan_period_type',$loan_period_type)
        ->with('loan_repayment_type',$loan_repayment_type);    
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
            if(DB::table('loan_products')->where('name',request('name'))->exists() == false)
                {
                    
                    $record = new loan_product();


                    $check_default = isset($request->is_default) ? '1':'0';
                    if($check_default == 1)
                    {
                        DB::table('loan_products')
                        ->update(array('is_default' => 0));
                    }


                    $loan_interest_method = loan_interest_method_type::where('id',request('interest_method'))->first();
                    $loan_period = loan_period_type::where('id',request('interest_period'))->first();
                    $loan_repayment = loan_repayment_type::where('id',request('repayment_cycle'))->first();

                    
                    $record->name = request('name');
                    $record->sub_title = request('sub_title');
                    $record->description = request('description');
                    $record->minimum_principal	 = request('minimum_principal');
                    $record->maximum_principal = request('maximum_principal');
                    $record->point = request('point');
                    $record->interest_method = $loan_interest_method->code;
                    $record->repayment_cycle = $loan_repayment->code;
                    $record->interest_period = $loan_period->code;
                    $record->override_interest =  isset($request->override_interest) ? '1':'0';
                    $record->override_interest_amount = request('override_interest_amount');
                    $record->interest_rate = request('interest_rate');
                    $record->is_default = isset($request->is_default) ? '1':'0';
                    $record->created_at = $date;
                    $record->updated_at = $date;
                    $record->user_id = Auth::user()->id;
                    

                    $record->save();
                    
                    Flash::success('Loan Product was created successfully.');
                    return redirect(route('manageloanproduct.index'));
                    
                }
                else
                {
                    Flash::error('Already existed Loan Product.');
                    return redirect(route('manageloanproduct.index'));
                }
            }
            else
            {
                Flash::warning('No Permission to Add New Loan Product.');
                return redirect()->route('manageloanproduct.index');
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
        $data = loan_product::findOrFail($id);
        $users = user::pluck('name','id');
        $loan_interest_method_type = loan_interest_method_type::get();
        $loan_period_type = loan_period_type::get();
        $loan_repayment_type = loan_repayment_type::get();
        $charge = charge::get();
        //$loan_product = loan_product_charge::where('loan_product_id',$id)->get();

                        
        return view('manageloanproduct.edit')
             ->with('users',$users)
             ->with('charge',$charge)
             ->with('loan_interest_method_type',$loan_interest_method_type)
             ->with('loan_period_type',$loan_period_type)
             ->with('loan_repayment_type',$loan_repayment_type)
             ->with('loan_product',$data)
             ->with(compact('data'));
    }

    public function get_charge_detail($charge)
    {
        
        $charge = charge::findorfail($charge);
        $json = [];
        $json["id"] = $charge->id;
        $json["name"] = $charge->name;
        $json["collected_on"] = charge_type::where('code',$charge->charge_type)->select('name')->pluck('name')->first();
        $json["amount"] = $charge->amount ." ". charge_option::where('code',$charge->charge_option)->select('name')->pluck('name')->first();

        return json_encode($json, JSON_UNESCAPED_SLASHES);
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

        $check_default = isset($request->is_default) ? '1':'0';
        if($check_default == 1)
        {
            DB::table('loan_products')
            ->update(array('is_default' => 0));
        }
        
        $record = loan_product::findOrFail($id);
        
       
        
        if($edit == '1')
        {

            //$loan_interest_method = loan_interest_method_type::where('id',request('interest_method'))->first();
           // $loan_period = loan_period_type::where('id',request('interest_period'))->first();
           // $loan_repayment = loan_repayment_type::where('id',request('repayment_cycle'))->first();
                                            
            $record->name = request('name');
            $record->sub_title = request('sub_title');
            $record->description = request('description');
            $record->minimum_principal	 = request('minimum_principal');
            $record->maximum_principal = request('maximum_principal');
            $record->point = request('point');
            $record->interest_method = request('interest_method');
            $record->repayment_cycle = request('repayment_cycle');
            $record->interest_period = request('interest_period');
            $record->override_interest =  isset($request->override_interest) ? '1':'0';
            $record->override_interest_amount = request('override_interest_amount');
            $record->interest_rate = request('interest_rate');
            $record->is_default = isset($request->is_default) ? '1':'0';
            $record->updated_at = $date;
                        
            $record->save();

            loan_product_charge::where('loan_product_id', $id)->delete();
            if (!empty($request->charges)) {
                //loop through the array
                foreach ($request->charges as $key) {
                    $loan_product_charge = new loan_product_charge();
                    $loan_product_charge->loan_product_id = $id;
                    $loan_product_charge->user_id = Auth::user()->id;
                    $loan_product_charge->charge_id = $key;
                    $loan_product_charge->save();
                }
            }
        
            Flash::success('Loan Product was editted successfully.');
            return redirect()->route('manageloanproduct.index');
        }
        else
        {
            Flash::warning('No Permission to Edit Loan Product.');
            return redirect()->route('manageloanproduct.index');
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
            $loan_product = loan_product::findorfail($id);
            $status = 0;
            if($loan_product->status == 1)
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            $loan_product->status = $status;
            $loan_product->save();
            
            Flash::success('Loan Product was deactivated or activated successfully.');
            return redirect()->route('manageloanproduct.index');
        }
        else
        {
            Flash::warning('You dont have permission deactivated or activated loan product.');
            return redirect()->route('manageloanproduct.index');
        }
    }
}