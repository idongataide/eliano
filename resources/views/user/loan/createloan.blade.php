@extends('layouts.user')
@section('title', 'new loan')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">NEW LOAN</span></h2>
        <p>Please carefully fill out the form to apply for a loan. Your can’t edit these details once you submitted the form.</p>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('danger') }}
            </div>
        @endif

        <div class="user-kyc">
        <form  action="{{route('user.post.loan') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="from-step">
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">01</div>
                                <div class="from-step-head">
                                    <h4>Step 1 : Loan Details</h4>
                                    <p>Simple Loan information, required for processing</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                
                                <div class="row">

                                <div class="gaps-2x"></div>
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Principal Amount</label>
                                            {!! Form::number('principal',$product->minimum_principal, array('class' => 'input-bordered', 'placeholder'=>"",'required'=>'required','id'=>'principal', 'name'=>'principal')) !!}
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Loan Product</label>
                                            <select class="country-select" name="loan_product_id" id="loan_product_id" required>
                                                <option value="">--select loan product--</option>
                                               @foreach($loan_product as $row)
                                                <option {{ ($row->id == $product_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                               @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Loan Duration</label>
                                            {!! Form::number('loan_duration',5, array('class' => 'input-bordered', 'placeholder'=>"5",'required'=>'required','id'=>'loan_duration')) !!}
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Duration Type</label>
                                            <select class="country-select" name="loan_duration_type" id="loan_duration_type" required>
                                                <option value="">--select loan duration type--</option>
                                               @foreach($loan_period_type as $row)
                                                <option {{ ($row->code == 'year')? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
                                               @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="nationality" class="input-item-label">Repayment Cycle</label>
                                            <select class="country-select" name="repayment_id" id="repayment_id" required>
                                                <option value="">--select repayment cycle--</option>

                                               @foreach($loan_repayment_type as $row)
                                                <option  {{ ($row->code == $product->repayment_cycle)? 'selected':'' }} value="{{  $row->code }}">{{ $row->name }}</option>
                                               @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->


                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <input type="hidden" id="website" name="website" value="{{$basic->website}}">
                                            <label for="date-of-birth" class="input-item-label">Expected Disburstment Date</label>
                                            <input class="input-bordered date-picker" type="text" value="" id="expected_disbursement_date" name="expected_disbursement_date" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Loan Interest Rate(%)</label>
                                            <input class="input-bordered" type="text" value="{{ $product->interest_rate }}" id="interest_rate" name="interest_rate" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Duration</label>
                                            <select class="country-select" name="interest_period" id="interest_period" required>
                                                <option value="">--select interest period--</option>
                                               
                                                @foreach($loan_period_type as $row)
                                                    <option {{ ($row->code == $product->interest_period)? 'selected':'' }} value="{{ $row->code }}"> Per {{ $row->name }}</option>
                                                @endforeach
                                               
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Overide Interest</label>
                                            <select class="country-select" name="overide_interest" id="overide_interest">
                                                <option value="">--select overide interest--</option>
                                                    @foreach($overide_interest as $row)
                                                        <option {{ ($row->code == $product->override_interest)? 'selected':'' }} value="{{ $row->code }}"> {{ $row->name }}</option>
                                                    @endforeach
                                                
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Grace on Interest Charge</label>
                                            {!! Form::number('grace_on_interest_charge',0, array('class' => 'input-bordered', 'placeholder'=>"0",'id'=>'grace_on_interest_charge','name'=>'grace_on_interest_charge')) !!}
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="description" class="input-item-label">Description</label>
                                            <textarea class="input-bordered" name="description" id="description"></textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-12">
                                        <div class="nk-kycfm-upload-box">
                                            <div class="upload-zone">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="loan_doc" id="loan_doc">
                                                    <label class="custom-file-label" for="customFile">Choose Loan Documents</label>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div><!-- .row -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                        <div class="gaps-2x"></div>
                           
                        
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">02</div>
                                <div class="from-step-head">
                                    <h4>Step 2 : Loan Charges</h4>
                                    <p>Our list of Charges</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                            <h4>Charges</h4>
                            <table id="data-table" class="table table-striped table-condensed table-hover refferal-table">
                                <thead>
                                    <tr>
                                        <th class="refferal-name"><span>Name</span></th>
                                        <th class="refferal-tokens"><span>Type</span></th>
                                        <th class="refferal-bonus"><span>Amount</span></th>
                                        <th class="refferal-date"><span>Collected On</span></th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach($charges as $row)
                                    <tr>
                                        <td class="refferal-name">{{$row->name}}</td>
                                        <td class="refferal-tokens">
                                        {{  App\Models\charge_option::where('code',$row->charge_option)->select('name')->pluck('name')->first()  }}           
                                        </td>
                                        <td class="refferal-bonus">{{ $row->amount }}</td>
                                        <td class="refferal-date">{{  App\Models\charge_type::where('code',$row->charge_type)->select('name')->pluck('name')->first()  }}   </td>
                                        
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>


                                <div class="gaps-2x"></div><!-- 20px gap -->
                                <button type="submit" class="btn btn-lg btn-primary">Apply</button>
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                    </div><!-- .from-step -->
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var website = $('#website').val(); 
  var address = '';

  $('#loan_product_id').change(function (e) {
        address = website+'/user/create-loan/'+$("#loan_product_id").val();
        window.location = address;
 })
   
});

</script>


@endsection