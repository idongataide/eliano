@extends('layouts.app_admin')
@section('title', 'manage repayment')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Manage Repayment</h1>
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
            <th>Loan ID</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Status</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ \App\Models\user::where('id',$row->borrower_id)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ $row->loan_id }}</td>
                    <td>{{ $row->payment_date }}</td>
                    <td>{{ \App\Models\loan_repayment_method::where('id',$row->payment_method)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ number_format($row->amount,2) }}</td>
                    <td>
                    @if($row->status=='pending')
                        <span class="label label-warning">Awaiting Approval</span>
                    @endif
                    @if($row->status=='rejected')
                    <span class="label label-danger">Declined</span>
                    @endif
                    @if($row->status=='approved')
                        <span class="label label-success">Approved</span>
                    @endif
                    @if($row->status=='deleted')
                        <span class="label label-danger">Deleted</span>
                    @endif
                    </td>
                    <td><a href="{!! route('admin.loan.repaymentdetails', [$row->id])  !!}" class='btn btn-default btn-xs' title="Payment Details"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>



            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
                
@endsection