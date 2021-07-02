<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\loan_repayment_method;
use App\Helpers\ImageUploadingHelper;
use App\Models\userpayment;
use App\Models\loan;
use App\Models\user;

use Validator;
use Flash;
use DB;
use File;
use auth;

class UserPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = userpayment::where('borrower_id',Auth::user()->id)->get();
                                   
        return view('managepayment.index')
                    ->with('data',$data);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loan = loan::where('borrower_id',Auth::user()->id)->where('status','disbursed')->get();
        $paymentmethod = loan_repayment_method::get();

         return view('managepayment.create')
                ->with('payment_method',$paymentmethod)
                ->with('loan',$loan);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                   
        $date = date("Y-m-d h:m:s");
        $pop = ImageUploadingHelper::upload_image("images/payment/",request('pop'),$request);
        
        $record = new userpayment();
        
        $record->borrower_id = Auth::user()->id;
        $record->loan_id = request('loan_id');
        $record->payment_date = request('payment_date');
        $record->teller = request('teller');
        $record->amount = request('amount');
        $record->payment_method = request('payment_method');
        $record->pop = $pop;
        $record->status = 'pending';
        $record->created_at = $date;
        $record->updated_at = $date;
                            
        $record->save();
                
        session()->flash('danger','payment was posted successfully.');
        return redirect(route('managepayment.index'));
                    
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
        $data = userpayment::findOrFail($id);
        $loan = loan::where('borrower_id',Auth::user()->id)->where('status','disbursed')->get();
        $paymentmethod = loan_repayment_method::get();
                                
        return view('managepayment.edit')
                ->with('loan',$loan)
                ->with('payment_method',$paymentmethod)
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
        $pop = ImageUploadingHelper::upload_image("images/payment/",request('pop'),$request);
        
        $record = userpayment::findorfail($id);
        
        if($record->status == "pending")
        {
            $record->loan_id = request('loan_id');
            $record->payment_date = request('payment_date');
            $record->teller = request('teller');
            $record->amount = request('amount');
            $record->payment_method = request('payment_method');
            $record->pop = isset($pop) ? $pop : $record->pop;
            $record->status = 'pending';
            $record->updated_at = $date;
                                
            $record->save();
                    
            session()->flash('success','payment was updated successfully.');
            return redirect(route('managepayment.index'));
        }
        else
        {
            session()->flash('danger','Once payment was approved or rejected, it cannot be updated.');
            return redirect(route('managepayment.index'));
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
        $record = userpayment::findOrFail($id);
        if($record->status == "pending")
        { 
            
            $record->status = "deleted";
            $record->save();
            
            session()->flash('success','payment was deleted successfully.');
            return redirect()->route('managepayment.index');
        }
        else
        {
            session()->flash('danger','Once payment was approved or rejected, it cannot be updated.');
            return redirect(route('managepayment.index'));
        }
    }
}