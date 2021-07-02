@extends('layouts.user')
@section('title', 'Loans')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">LOAN OVERVIEW</span></h2>
        <p>An overview of loans you requested and received.</p>
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
        <div class="alert-box row">
            <div class="alert-txt"></div>
            <a href="{{ route('user.loan.createloan',[App\Models\loan_product::where('is_default',1)->select('id')->pluck('id')->first()]) }}" class="btn btn-sm btn-primary">New Loan</a>
        </div>


                     <h4>Loan Lists</h4>
                        <table id="data-table" class="table table-striped table-condensed table-hover refferal-table">
                            <thead>
                                <tr>
                                    <th class="refferal-name"><span>SN</span></th>
                                    <th class="refferal-tokens"><span>Principal</span></th>
                                    <th class="refferal-bonus"><span>Balance</span></th>
                                    <th class="refferal-date"><span>Disbursed</span></th>
                                    <th class="refferal-channel"><span>Product</span></th>
                                    <th class="refferal-status"><span>Status</span></th>
                                    <th class="tranx-action">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach($data as $row)
                                <tr>
                                    <td class="refferal-name">{{ $i++ }}</td>
                                    <td class="refferal-tokens">{{ $basic->currency_sym }}{{ number_format($row->principal,2) }}</td>
                                    <td class="refferal-bonus">{{ $basic->currency_sym }}{{number_format(\App\Helpers\GeneralHelper::loan_total_balance($row->id),2)}}</td>
                                    <td class="refferal-date">{{$row->disbursed_date}}</td>
                                    <td class="refferal-channel">{{ App\Models\loan_product::where('id',$row->loan_product_id)->select('name')->pluck('name')->first()}}</td>
                                    <td class="refferal-status">

                                    @if($row->maturity_date<date("Y-m-d") && \App\Helpers\GeneralHelper::loan_total_balance($row->id)>0)
                                        <span class="label label-danger">Past Maturity</span>
                                    @else
                                        @if($row->status=='pending')
                                            <span class="label label-warning">Pending Approval</span>
                                        @endif
                                        @if($row->status=='approved')
                                            <span class="label label-warning">Awaiting Disbursement</span>
                                        @endif
                                        @if($row->status=='disbursed')
                                            <span class="label label-info">Active</span>
                                        @endif
                                        @if($row->status=='declined')
                                            <span class="label label-danger">Declined</span>
                                        @endif
                                        @if($row->status=='withdrawn')
                                            <span class="label label-danger">Withdrawn</span>
                                        @endif
                                        @if($row->status=='written_off')
                                            <span class="label label-danger">Written off</span>
                                        @endif
                                        @if($row->status=='closed')
                                            <span class="label label-success">Closed</span>
                                        @endif
                                        @if($row->status=='pending_reschedule')
                                            <span class="label label-warning">Pending Reschedule</span>
                                        @endif
                                        @if($row->status=='rescheduled')
                                            <span class="label label-info">Rescheduled</span>
                                        @endif
                                    @endif

                                    </td>
                                    <td class="tranx-action">
                                       <a href="{{ route('user.loan.details',[$row->id]) }}"><em class="ti ti-more-alt"></em></a>
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