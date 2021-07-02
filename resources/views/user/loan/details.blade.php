@extends('layouts.user')
@section('title', 'Loan Details')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">LOAN DETAILS</span></h2>
        <p>A details and summary of your loans.</p>
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


        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#details">Details</a>
            </li>
           {{-- @if($loan->status=="disbursed" || $loan->status=="closed" || $loan->status=="withdrawn" || $loan->status=="written_off" || $loan->status=="rescheduled" )--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#repayment-schedule">Schedules</a>
            </li>
            {{--@endif--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#summary">Summary</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#transaction">Transactions</a>
            </li>
            </ul><!-- .nav-tabs-line -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="details">
                            <div class="user-kyc">
                            <form  action="{{route('user.update.loan') }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                         <div class="from-step">
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">01</div>
                                <div class="from-step-head">
                                    <h4>Step 1 : Loan Details</h4>
                                </div>
                            </div>
                            <div class="from-step-content">
                                
                                <div class="row">

                                <div class="gaps-2x"></div>
                                   
                                <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Principal Amount</label>
                                            {!! Form::number('principal',$loan->principal, array('class' => 'input-bordered', 'placeholder'=>"",'required'=>'required','id'=>'principal', 'name'=>'principal')) !!}
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Loan Product</label>
                                            <select class="country-select" name="loan_product_id" id="loan_product_id" required>
                                                <option value="">--select loan product--</option>
                                               @foreach($loan_product as $row)
                                                <option {{ ($row->id == $loan->loan_product_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
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
                                                <option {{ ($row->code == $loan->loan_duration_type)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
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
                                                <option  {{ ($row->code == $loan->repayment_cycle)? 'selected':'' }} value="{{  $row->code }}">{{ $row->name }}</option>
                                               @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->


                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <input type="hidden" id="website" name="website" value="{{$basic->website}}">
                                            <input type="hidden" id="loan_id" name="loan_id" value="{{$loan->id}}">
                                            <label for="date-of-birth" class="input-item-label">Expected Disburstment Date</label>
                                            <input class="input-bordered date-picker" type="text" value="{{ $loan->release_date }}" id="expected_disbursement_date" name="expected_disbursement_date" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Loan Interest Rate(%)</label>
                                            <input class="input-bordered" type="text" value="{{ $loan->interest_rate }}" id="interest_rate" name="interest_rate" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="loanproduct" class="input-item-label">Duration</label>
                                            <select class="country-select" name="interest_period" id="interest_period" required>
                                                <option value="">--select interest period--</option>
                                               
                                                @foreach($loan_period_type as $row)
                                                    <option {{ ($row->code == $loan->interest_period)? 'selected':'' }} value="{{ $row->code }}"> Per {{ $row->name }}</option>
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
                                                        <option {{ ($row->code == $loan->override_interest)? 'selected':'' }} value="{{ $row->code }}"> {{ $row->name }}</option>
                                                    @endforeach
                                                
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Grace on Interest Charge</label>
                                            {!! Form::number('grace_on_interest_charged',0, array('class' => 'input-bordered', 'placeholder'=>"0",'id'=>'grace_on_interest_charged','name'=>'grace_on_interest_charged')) !!}
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="description" class="input-item-label">Description</label>
                                            <textarea class="input-bordered" name="description" id="description">{{$loan->description}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                                                 
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
                                @if($loan->status=="pending" )
                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                @endif
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                    </div><!-- .from-step -->
                </form>
            </div>
                            </div><!-- .tab-pane -->
                            <div class="tab-pane fade" id="repayment-schedule">
                                <p>Repayment Summary.</p>
                                <div class="box box-success">
                                <div class="panel-body table-responsive no-padding">
                                <table id="data-table" class="table table-striped table-condensed table-hover tranx-table">
                                            <tbody>
                                            <tr>
                                                <th>
                                                    <b>#</b>
                                                </th>
                                                <th>
                                                    <b>Date</b>
                                                </th>
                                                <th>
                                                    <b>Paid by</b>
                                                </th>
                                                <th>
                                                    <b>Description</b>
                                                </th>
                                                <th style="">
                                                    <b>Principal</b>
                                                </th>
                                                <th >
                                                    <b>Interest</b>
                                                </th>
                                                <th>
                                                    <b>Fee</b>
                                                </th>
                                                <th>
                                                    <b>Penalty</b>
                                                </th>

                                                <th>
                                                    <b>Due</b>
                                                </th>
                                                <th>
                                                    <b>Paid</b>
                                                </th>
                                                <th>
                                                    <b>Pending Due</b>
                                                </th>
                                                <th>
                                                    <b>Principal Balance</b>
                                                </th>
                                            </tr>
                                            <?php
                                            //check for disbursement charges
                                            $disbursement_charges = \App\Models\loantransaction::where('loan_id',
                                                $loan->id)->where('transaction_type',
                                                'disbursement_fee')->where('reversed', 0)->sum('debit');
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td>{{$loan->release_date}}</td>
                                                <td></td>
                                                <td>Disbursement</td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align:right;">
                                                    @if(!empty($disbursement_charges))
                                                        <b>{{number_format($disbursement_charges,2)}}</b>
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td style="text-align:right;">
                                                    @if(!empty($disbursement_charges))
                                                        <b>{{number_format($disbursement_charges,2)}}</b>
                                                    @endif
                                                </td>
                                                <td style="text-align:right;">
                                                    @if(!empty($disbursement_charges))
                                                        <b>{{number_format($disbursement_charges,2)}}</b>
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Models\loanschedule::where('loan_id',
                                                    $loan->id)->sum('principal'),2)}}
                                                </td>
                                            </tr>
                                            <?php
                                            $timely = 0;
                                            $total_overdue = 0;
                                            $overdue_date = "";
                                            $total_till_now = 0;
                                            $count = 1;
                                            $total_due = 0;
                                            $principal_balance = \App\Models\loanschedule::where('loan_id',
                                                $loan->id)->sum('principal');
                                            $payments = \App\Helpers\GeneralHelper::loan_total_paid($loan->id);
                                            $total_paid = $payments;
                                            $next_payment = [];
                                            $next_payment_amount = "";
                                            foreach ($loan->schedules as $schedule) {
                                            $principal_balance = $principal_balance - $schedule->principal;
                                            $total_due = $total_due + ($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived);
                                            $paid = 0;
                                            $paid_by = '';
                                            $overdue = 0;
                                            $due = $schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived;
                                            if ($payments > 0) {
                                                if ($payments > $due) {
                                                    $paid = $due;
                                                    $payments = $payments - $due;
                                                    //find the corresponding paid by date
                                                    $p_paid = 0;
                                                    foreach (\App\Models\loantransaction::where('loan_id',
                                                        $loan->id)->where('transaction_type',
                                                        'repayment')->where('reversed', 0)->orderBy('date',
                                                        'asc')->get() as $key) {
                                                        $p_paid = $p_paid + $key->credit;
                                                        if ($p_paid >= $total_due) {
                                                            $paid_by = $key->date;
                                                            if ($key->date > $schedule->due_date && date("Y-m-d") > $schedule->due_date) {
                                                                $overdue = 1;
                                                                $total_overdue = $total_overdue + 1;
                                                                $overdue_date = '';
                                                            }
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $paid = $payments;
                                                    $payments = 0;
                                                    if (date("Y-m-d") > $schedule->due_date) {
                                                        $overdue = 1;
                                                        $total_overdue = $total_overdue + 1;
                                                        $overdue_date = $schedule->due_date;
                                                    }
                                                    $next_payment[$schedule->due_date] = (($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived) - $paid);
                                                }
                                            } else {
                                                if (date("Y-m-d") > $schedule->due_date) {
                                                    $overdue = 1;
                                                    $total_overdue = $total_overdue + 1;
                                                    $overdue_date = $schedule->due_date;
                                                }
                                                $next_payment[$schedule->due_date] = (($schedule->principal + $schedule->interest + $schedule->fees + $schedule->penalty- $schedule->interest_waived));
                                            }
                                            $outstanding = $due - $paid;
                                            //check if the schedule has been paid in time


                                            ?>
                                            <tr class="@if($overdue==1) danger  @endif @if($overdue==0 && $outstanding==0) success  @endif">
                                                <td>
                                                    {{$count}}
                                                </td>
                                                <td>
                                                    {{$schedule->due_date}}
                                                </td>
                                                <td style="">
                                                    @if(empty($paid_by) && $overdue==1)
                                                        Overdue
                                                    @endif
                                                    @if(!empty($paid_by) && $overdue==1)
                                                        {{$paid_by}} <i class="fa fa-minus-circle" data-toggle="tooltip"
                                                                        title="Late"></i>
                                                    @endif
                                                    @if(!empty($paid_by) && $overdue==0)
                                                        {{$paid_by}} <i class="fa fa-check-circle" data-toggle="tooltip"
                                                                        title="Timely"></i>
                                                    @endif

                                                </td>
                                                <td>
                                                    {{$schedule->description}}
                                                </td>
                                                <td style="text-align:right">
                                                    {{number_format($schedule->principal,2)}}
                                                </td>
                                                <td style="text-align:right">
                                                    @if($schedule->interest_waived>0)
                                                        <s> {{number_format($schedule->interest_waived,2)}}</s>
                                                    @endif
                                                    {{number_format($schedule->interest,2)}}
                                                </td>
                                                <td style="text-align:right">
                                                    {{number_format($schedule->fees,2)}}
                                                </td>
                                                <td style="text-align:right">
                                                    {{number_format($schedule->penalty,2)}}
                                                </td>
                                                <td style="text-align:right; font-weight:bold">
                                                    {{number_format($due,2)}}
                                                </td>

                                                <td style="text-align:right;">
                                                    {{number_format($paid,2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format($outstanding,2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format($principal_balance,2)}}
                                                </td>

                                            </tr>
                                            <?php
                                            $count++;
                                            }
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="font-weight:bold">Total Due</td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Helpers\GeneralHelper::loan_total_principal($loan->id),2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Helpers\GeneralHelper::loan_total_interest($loan->id)-\App\Helpers\GeneralHelper::loan_total_interest_waived($loan->id),2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Helpers\GeneralHelper::loan_total_fees($loan->id)+$disbursement_charges,2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Helpers\GeneralHelper::loan_total_penalty($loan->id),2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format($total_due+$disbursement_charges,2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format($total_paid+$disbursement_charges,2)}}
                                                </td>
                                                <td style="text-align:right;">
                                                    {{number_format(\App\Helpers\GeneralHelper::loan_total_balance($loan->id),2)}}
                                                </td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                       </div>
                                    </div>
                            <div class="tab-pane fade" id="transaction">
                                <div class="box box-info">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table id="repayments-data-table"
                                                           class="table  table-condensed table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>
                                                                id
                                                            </th>
                                                            <th>
                                                                Date
                                                            </th>
                                                            <th>
                                                                Submitted on
                                                            </th>
                                                            <th>
                                                                Type
                                                            </th>

                                                            <th>
                                                                Debit
                                                            </th>
                                                            <th>
                                                                Credit
                                                            </th>
                                                            <th>
                                                                Balance
                                                            </th>
                                                            <th>
                                                                Detail
                                                            </th>
                                                           
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $balance = 0;
                                                        ?>
                                                        @foreach(\App\Models\loantransaction::orderby('id','desc')->where('loan_id',$loan->id)->whereIn('reversal_type',['user','none'])->get() as $key)
                                                            <?php
                                                            $balance = $balance + ($key->debit - $key->credit);
                                                            ?>
                                                            <tr>
                                                                <td>{{$key->id}}</td>
                                                                <td>{{$key->date}}</td>
                                                                <td>{{$key->created_at}}</td>
                                                                <td>{{ \App\Models\loan_transaction_type::where('code',$key->transaction_type)->select('name')->pluck('name')->first()  }}

                                                                      @if($key->reversed==1)
                                                                        @if($key->reversal_type=="user")
                                                                            <span class="text-danger"><b>(User Reversed)</b></span>
                                                                        @endif
                                                                        @if($key->reversal_type=="system")
                                                                            <span class="text-danger"><b>(System Reversed)</b></span>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>{{number_format($key->debit,2)}}</td>
                                                                <td>{{number_format($key->credit,2)}}</td>
                                                                <td>{{number_format($balance,2)}}</td>
                                                                <td>{{$key->receipt}}</td>
                                                                
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                            </div><!-- .tab-pane -->

                            <div class="tab-pane fade" id="summary">


                           
                                    <?php
                                    $loan_due_items = \App\Helpers\GeneralHelper::loan_due_items($loan->id,
                                        $loan->release_date, date("Y-m-d"));
                                    $loan_paid_items = \App\Helpers\GeneralHelper::loan_paid_items($loan->id,
                                        $loan->release_date, date("Y-m-d"));

                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Timely Repayment
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $count = \App\Models\LoanSchedule::where('due_date', '<=',
                                                        date("Y-m-d"))->where('loan_id', $loan->id)->count();
                                                    ?>
                                                    @if($count>0)
                                                        <h6><b>{{round(($count-$total_overdue)/$count)}}%</b></h6>
                                                    @else
                                                        <h6><b>0 %</b></h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Amount in  arrears
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    @if(($loan_due_items["principal"]+$loan_due_items["interest"]+$loan_due_items["fees"]+$loan_due_items["penalty"])>($loan_paid_items["principal"]+$loan_paid_items["interest"]+$loan_paid_items["fees"]+$loan_paid_items["penalty"]))
                                                        <h6><b>
                                                                <span class="text-danger">{{number_format(($loan_due_items["principal"]+$loan_due_items["interest"]+$loan_due_items["fees"]+$loan_due_items["penalty"])-($loan_paid_items["principal"]+$loan_paid_items["interest"]+$loan_paid_items["fees"]+$loan_paid_items["penalty"]),2)}}</span></b>
                                                        </h6>
                                                    @else
                                                        <h6><b> <span class="text-danger">0.00</span></b></h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Day in arrears
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    @if(!empty($overdue_date))
                                                        <?php
                                                        $date1 = new DateTime($overdue_date);
                                                        $date2 = new DateTime(date("Y-m-d"));
                                                        ?>
                                                        <h6>
                                                            <b><span class="text-danger">{{$date2->diff($date1)->format("%a")}}</span></b>
                                                        </h6>
                                                    @else
                                                        <h6><b> <span class="text-danger">0</span></b></h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Last Payment
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $last_payment = \App\Models\loantransaction::where('loan_id',
                                                        $loan->id)->where('transaction_type',
                                                        'repayment')->where('reversed', 0)->orderBy('date',
                                                        'desc')->first();
                                                    ?>
                                                    @if(!empty($last_payment))
                                                        <h6><b>{{number_format($last_payment->credit)}}
                                                                on {{$last_payment->date}}</b></h6>
                                                    @else
                                                        ----
                                                    @endif
                                                </div>
                                            </div>
                                            <!--
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Next Payment
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $count = \App\Models\loanschedule::where('due_date', '<=',
                                                        date("Y-m-d"))->where('loan_id', $loan->id)->count();
                                                    ?>
                                                    @foreach($next_payment as $key=>$value)
                                                        <?php
                                                        if ($key > date("Y-m-d")) {
                                                            echo ' <h6><b>' . number_format($value) . ' on ' . $key . '</b></h6>';
                                                        }
                                                        ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                                    -->
                                            
                                            <div class="row">
                                                <div class="col-md-6"><h6>
                                                        <b>Last Payment Expected
                                                            :</b></h6></div>
                                                <div class="col-md-6">
                                                    <h6>
                                                        <b>{{\App\Models\LoanSchedule::where('loan_id', $loan->id)->orderBy('due_date','asc')->get()->last()->due_date}}</b>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <table class="table table-bordered table-condensed">
                                        <tbody>
                                        <tr>
                                            <th width="200">
                                                <b>Item:</b>
                                            </th>
                                            <th style="text-align:right;">
                                                <b>Principal</b>
                                            </th>
                                            <th style="text-align:right;">
                                                <b>Interest</b>
                                            </th>
                                            <th style="text-align:right;">
                                                <b>Fee</b>
                                            </th>
                                            <th style="text-align:right;">
                                                <b>Penalty</b>
                                            </th>
                                            <th style="text-align:right;">
                                                <b>Total</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="text-bold bg-danger">
                                                Total Due
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format(\App\Helpers\GeneralHelper::loan_total_principal($loan->id),2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format(\App\Helpers\GeneralHelper::loan_total_interest($loan->id),2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format(\App\Helpers\GeneralHelper::loan_total_fees($loan->id)+$disbursement_charges,2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format(\App\Helpers\GeneralHelper::loan_total_penalty($loan->id),2)}}
                                            </td>
                                            <td style="text-align:right; font-weight:bold">
                                                {{number_format(\App\Helpers\GeneralHelper::loan_total_due_amount($loan->id)+$disbursement_charges,2)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold bg-green">
                                                Total Paid
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format($loan_paid_items['principal'],2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format($loan_paid_items['interest'],2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format($loan_paid_items['fees']+$disbursement_charges,2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format($loan_paid_items['penalty'],2)}}
                                            </td>
                                            <td style="text-align:right; font-weight:bold">
                                                {{number_format(($loan_paid_items['principal']+$loan_paid_items['interest']+$loan_paid_items['fees']+$loan_paid_items['penalty'])+$disbursement_charges,2)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold btn-info">
                                                Balance
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format((\App\Helpers\GeneralHelper::loan_total_principal($loan->id)-$loan_paid_items['principal']),2)}}
                                            </td>
                                            <td style="text-align:right">
                                                {{number_format((\App\Helpers\GeneralHelper::loan_total_interest($loan->id)-$loan_paid_items['interest']),2)}}

                                            </td>
                                            <td style="text-align:right">
                                                {{number_format((\App\Helpers\GeneralHelper::loan_total_fees($loan->id)-$loan_paid_items['fees']),2)}}

                                            </td>
                                            <td style="text-align:right">
                                                {{number_format((\App\Helpers\GeneralHelper::loan_total_penalty($loan->id)-$loan_paid_items['penalty']),2)}}

                                            </td>
                                            <td style="text-align:right; font-weight:bold">
                                                {{number_format((\App\Helpers\GeneralHelper::loan_total_due_amount($loan->id)-($loan_paid_items['principal']+$loan_paid_items['interest']+$loan_paid_items['fees']+$loan_paid_items['penalty'])),2)}}

                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                
                            </div>

                        </div><!-- .tab-content -->

                                                                                                                                                                            















</div>
</div>
</div>

@endsection