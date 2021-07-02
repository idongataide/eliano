@extends('layouts.user')
@section('title', 'dashboard')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title">DASHBOARD</h2>
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


        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tile-item tile-primary">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">CURRENT LOAN BALANCE</h6>
                                    <h1 class="tile-info">{{number_format(\App\Helpers\GeneralHelper::borrower_loans_total_due(Auth::user()->id)-\App\Helpers\GeneralHelper::borrower_loans_total_paid(Auth::user()->id))}}</h1>
                                    <ul class="tile-list-inline">
                                        <li style="color:yellow"><b>{{number_format(App\Helpers\GeneralHelper::borrower_loans_total_paid(Auth::user()->id,2))}}</b> PAID</li>
                                        <li>-</li>
                                        <li style="color:yellow"><b>{{number_format(\App\Helpers\GeneralHelper::borrower_loans_total_due(Auth::user()->id),2)}}</b> DUE</li>
                                    </ul>
                                </div>
                            </div><!-- .col -->




                            <div class="col-md-6">
                                <div class="tile-item tile-light">
                                    <div class="tile-bubbles"></div>
                                    <h6 class="tile-title">CONTRIBUTIONS</h6>
                                    <ul class="tile-info-list">

                                    @if(Auth::user()->roleid == 5)
                                        <li><span>{{$basic->currency_sym . number_format(\App\Models\contribution::where('merchant_id',Auth::user()->id)->where('status',2)->sum('amount'),2)}}</span>AMOUNT</li>
                                        <li><span>~</span></li>
                                        <li><span>{{\App\Models\user::where('referby',Auth::user()->id)->count()}}</span>CONTRIBUTORS</li>
                                    @endif

                                    @if(Auth::user()->roleid == 4)
                                        <li><span>{{$basic->currency_sym . number_format(\App\Models\contribution::where('contributor_id',Auth::user()->id)->where('status',2)->sum('amount'),2)}}</span>AMOUNT</li>
                                        <li><span>~</span></li>
                                        <li><span>{{\App\Models\contribution::where('contributor_id',Auth::user()->id)->count()}}</span>Times Contributed</li>
                                    @endif

                                    </ul>
                                </div>
                            </div><!-- .col -->



                        </div><!-- .row -->
                        <div class="info-card info-card-bordered">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <div class="info-card-image">
                                        <img src="{{ asset('/images/') .'/'. $basic->site_image }}" alt="vector">
                                    </div>
                                    <div class="gaps-2x d-md-none"></div>
                                </div>
                                <div class="col-sm-9">
                                    <h4>Thank you for your interest towards our {{$basic->name}}</h4>
                                    <p>You can get fast track loan in <a href="{{ route('user.loan.index') }}">Loans</a> section.</p>
                                    <p>You can get a quick response to any questions, and chat with the project in our Telegram: <a href="htts://t.me/icocrypto">htts://t.me/icocrypto</a></p>
                                    <p>Don’t hesitate to invite your friends! If your invited referral get loans then you will get bonus.</p>
                                </div>
                            </div>
                        </div><!-- .info-card -->
                      
                        @if(Auth::user()->roleid == 4)
                        <div class="progress-card">
                        <?php
                            $target = 0;
                            foreach (\App\Models\loanschedule::where('borrower_id',Auth::user()->id)->get() as $key) {
                                $target = $target + $key->principal + $key->interest + $key->fees + $key->penalty;
                            }
                            $paid_this_month = \App\Models\loantransaction::where('transaction_type',
                                'repayment')->where('reversed', 0)->where('borrower_id',Auth::user()->id)->sum('credit');
                            if ($target > 0) {
                                $percent = round(($paid_this_month / $target) * 100);
                            } else {
                                $percent = 0;
                            }
                        ?>

                            <h4>Repayment Progress</h4>
                            <ul class="progress-info">
                                <li><span>TARGET-</span> {{number_format(App\Helpers\GeneralHelper::borrower_loans_total_due(Auth::user()->id,2))}}</li>
                                <li><span>BALANCE-</span> {{number_format(\App\Helpers\GeneralHelper::borrower_loans_total_due(Auth::user()->id)-\App\Helpers\GeneralHelper::borrower_loans_total_paid(Auth::user()->id))}}</li>
                            </ul>
                            <div class="progress-bar">
                                <div class="progress-percent" title="Target:{{number_format($target,2)}}" style="width:{{$percent}}%">
                                    <br>
                                    <span>{{$percent}}% Complete</span>
                                    <span style="font-weight: 300; color: #ff5f5f; float: left;">{{ \App\Models\loanschedule::where('due_date','>',date('Y-m-d'))->orderBy('due_date','asc')->first()->due_date }} Next Payment Date</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="gaps-3x"></div>
                        <h4>Contribution Transactions</h4>
                        <table class="data-table refferal-table">
                            <thead>
                                <tr>
                                    <th class="refferal-sn"><span>SN</span></th>
                                    <th class="refferal-date"><span>Date</span></th>
                                    <th class="refferal-name"><span>Contributor</span></th>
                                    <th class="refferal-tokens"><span>Bank</span></th>
                                    <th class="refferal-bonus"><span>Amount</span></th>
                                    <th class="refferal-channel"><span>Status</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1  ?>
                                @foreach($contribution as $row)
                                <tr>
                                    <td class="refferal-sn">{{ $i++ }}</td>
                                    <td class="refferal-date">{{$row->payment_date}}</td>
                                    <td class="refferal-name">{{  App\Models\user::where('id',$row->contributor_id)->select('name')->pluck('name')->first()  }}</td>
                                    <td class="refferal-tokens">{{  App\Models\bank::where('id',$row->baink_id)->select('name')->pluck('name')->first()  }}</td>
                                    <td class="refferal-bonus">{{$row->amount}}</td>
                                    
                                    <td class="refferal-channel">
                                    @if($row->status=='1')
                                        <span class="label label-warning">Pending Approval</span>
                                    @endif
                                    @if($row->status=='2')
                                        <span class="label label-success">Approved</span>
                                    @endif
                                    @if($row->status=='3')
                                        <span class="label label-danger">Cancelled</span>
                                    @endif
                                    </td>
                                </tr>   
                                @endforeach                                    
                            </tbody>
                        </table>
                        </div>
                </div>
</div>
</div>
    
@endsection