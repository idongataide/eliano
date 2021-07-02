@extends('layouts.app_admin')
@section('title', 'loan details')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Loan Details</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">

            <div class="loan">

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>borrower's Personal Details</b></div>
                        <div class="panel-body">
                        <div class="table-responsive">
                         <table id="example12" name="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Membership</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Business Address</th>
                            <th>Loaction</th>
                            <th>Contribution Plan</th>                    
                        </tr>
                        </thead>
                        <tbody>
                                                      
                                <tr>
                                    <td>{{$borrower->reg_no}}</td>
                                    <td>{{$borrower->name}}</td>
                                    <td>{{ Carbon\carbon::parse($borrower->dob)->age }}</td>
                                    <td>{{ App\Models\gender::where('id',$borrower->gender)->select('name')->pluck('name')->first()  }}</td>
                                    <td>{{$borrower->phonenumber}}</td>
                                    <td>{{$borrower->email}}</td>
                                    <td>{{$borrower->business_address}}</td>
                                    <td>{{$borrower->Location}}</td>
                                    <td>{{$borrower->plan_name}}</td>
                                </tr>
                          
                        </tbody>     
                    </table>   
                </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Banking Details</b></div>
                        <div class="panel-body">
                        <div class="table-responsive">
                         <table id="example12" name="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>BVN</th>
                            <th>Bank</th>                  
                        </tr>
                        </thead>
                        <tbody>
                                                   
                                <tr>
                                    <td>{{$borrower->accountname}}</td>
                                    <td>{{$borrower->account_no}}</td>
                                    <td>{{$borrower->bvn}}</td>
                                    <td>{{App\Models\bank::where('id',$borrower->gender)->select('name')->pluck('name')->first()}}</td>
                                </tr>
                          
                        </tbody>     
                    </table>   
                </div>
                        </div>
                    </div>
                </div>
            

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Loans Details</b> 
                        <span> 

                        @if($loan->maturity_date<date("Y-m-d") && \App\Helpers\GeneralHelper::loan_total_balance($loan->id)>0)
                            <span class="label label-danger">Past Maturity</span>
                        @else
                            @if($loan->status=='pending')
                                <span class="label label-warning">Pending Approval</span>
                            @endif
                            @if($loan->status=='approved')
                                <span class="label label-info">Awaiting Disbursement</span>
                            @endif
                            @if($loan->status=='disbursed')
                                <span class="label label-info">Active</span>
                            @endif
                            @if($loan->status=='declined')
                                <span class="label label-danger">Declined</span>
                            @endif
                            @if($loan->status=='withdrawn')
                                <span class="label label-danger">Withdrawn</span>
                            @endif
                            @if($loan->status=='written_off')
                                <span class="label label-danger">Written off</span>
                            @endif
                            @if($loan->status=='closed')
                                <span class="label label-success">Closed</span>
                            @endif
                            @if($loan->status=='pending_reschedule')
                                <span class="label label-warning">Pending Reschedule</span>
                            @endif
                            @if($loan->status=='rescheduled')
                                <span class="label label-info">Rescheduled</span>
                            @endif
                        @endif
                        </span> 
                    </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <table id="example123" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Duration</th>
            <th>Repayment Cycle</th>
            <th>Interest Rate</th>
            <th>Principal</th>
            <th>Interest</th>
            <th>Due</th>
            <th>Paid</th>
            <th>Balance</th>
            
            </tr>
        </thead>
        <tbody>
        
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td><small>{{ $loan->loan_duration }} {{ $loan->loan_duration_type }}(s)</small></td>
                    <td>{{ $loan->repayment_cycle }}</td>
                    <td>{{ round($loan->interest_rate,2) }}%/{{$loan->interest_period}}</td>
                    <td>{{ number_format($loan->principal,2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_interest($loan->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_due_amount($loan->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_paid($loan->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_balance($loan->id),2) }}</td>

                    
                    
                </tr>
           
        </tbody>
                
    </table>   
</div>
                        </div>
                    </div>
                </div>

              
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#manage" data-toggle="tab">Manage Loan</a></li>
              <li><a href="#schedule" data-toggle="tab">Repayment Schedule</a></li>
              <li><a href="#summary" data-toggle="tab">Summary</a></li>
              <li><a href="#transaction" data-toggle="tab">Transactions</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="manage"> 
              <p>Manage Loan through approving, disburse etc.</p>
            <div class="box box-success">
            <div class="panel-body no-padding">
             <div class="row" >
              <div class="form">
                    {!! Form::open(['route' => 'postloandetails','files' => true]) !!}
                        <div class="form-group">
                            <input type="hidden" id="loan_id" name="loan_id" value="{{$loan->id}}">
                            {!! Form::label('status_id', 'Category:',['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-8">
                                    <select class="form-control" id="status_id" name="status_id" required>
                                        <option value="">Choose status...</option>
                                        @foreach ($loan_status as $row)
                                            <option  {{ ($row->code == $loan->status)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                        {!! Form::label('date', 'Date:',['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                                    <input type="text" class="form-control datepicker" required name="date" value="{{$date}}" >
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="firstpaymentdate">
                        {!! Form::label('date', 'First Payment Date:',['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                                    <input type="text" class="form-control datepicker" name="first_payment_date" value="{{$date}}" >
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="approved_amt">
                            {!! Form::label('amount', 'Approved Amount:',['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::number('principal', $loan->principal, ['class' => 'form-control']) !!}
                        </div>
                        </div>

                        <div class="form-group">  
                            <label for="remark" class="col-sm-3 control-label">Remarks:</label>
                            <div class="col-sm-8">       
                                {!! Form::textarea('description', $loan->description, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('admin.loan.loan') !!}" class="btn btn-default">Back</a>
                        </div>
                        </div>

                    {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
              </div>



              <div class="tab-pane" id="schedule">
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
                                                if ($payments >= $due) {
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
                                                        {{$paid_by}} <i class="fa fa-minus-circle" data-toggle="tooltip" title="Late"></i>
                                                    @endif
                                                    @if(!empty($paid_by) && $overdue==0)
                                                        {{$paid_by}} <i class="fa fa-check-circle" data-toggle="tooltip" title="Timely"></i>
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





              <div class="tab-pane" id="summary">

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
             




              <div class="tab-pane" id="transaction">
                
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
                  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>



























                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var website = $('#website').val(); 
  $("#approved_amt").hide();
  $("#firstpaymentdate").hide();
  

  $('#status_id').change(function (e) {
    var status = $("#status_id").val();
    if(status == "approved")
    {
        $("#firstpaymentdate").hide();
        $("#approved_amt").show();
        
    }
    else if(status == "disbursed")
    {

        $("#firstpaymentdate").show();
        $("#approved_amt").hide();
    }
    else
    {
        $("#firstpaymentdate").hide();
        $("#approved_amt").hide();
    }
 })
   
});

</script>

@endsection