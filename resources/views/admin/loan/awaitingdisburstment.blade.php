@extends('layouts.app_admin')
@section('title', 'awaiting disburstment')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Awaiting Disburstment</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

    <div class="box box-primary">
    <div class="box-body">
                

    <div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Borrower</th>
            <th>Released</th>
            <th>Duration</th>
            <th>Repayment Cycle</th>
            <th>Interest Rate</th>
            <th>Principal</th>
            <th>Interest</th>
            <th>Due</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Status</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($loan as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ App\Models\user::where('id',$row->borrower_id)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ $row->release_date }}</td>
                    <td>{{ $row->loan_duration }} {{ $row->loan_duration_type }}(s)</td>
                    <td>{{ $row->repayment_cycle }}</td>
                    <td>{{ round($row->interest_rate,2) }}%/{{$row->interest_period}}</td>
                    <td>{{ number_format($row->principal,2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_interest($row->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_due_amount($row->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_paid($row->id),2) }}</td>
                    <td>{{ number_format(\App\Helpers\GeneralHelper::loan_total_balance($row->id),2) }}</td>

                    <td>
                        @if($row->maturity_date<date("Y-m-d") && \App\Helpers\GeneralHelper::loan_total_balance($row->id)>0)
                            <span class="label label-danger">Past Maturity</span>
                        @else
                            @if($row->status=='pending')
                                <span class="label label-warning">Pending Approval</span>
                            @endif
                            @if($row->status=='approved')
                                <span class="label label-info">Awaiting Disbursement</span>
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
                    <td><a href="{!! route('admin.loan.details', [$row->id])  !!}" class='btn btn-default btn-xs' title="Overview"><i class="glyphicon glyphicon-edit"></i></a></td>
                                       
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
                
@endsection

