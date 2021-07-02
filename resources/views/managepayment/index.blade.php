@extends('layouts.user')
@section('title', 'manage payment')
@section('content')
<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">REPAYMENT OVERVIEW</span></h2>
        <p>Manage Repayment.</p>
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
            <a href="{{ route('managepayment.create') }}" class="btn btn-sm btn-primary">New Payment</a>
        </div>


                     <h4>Payment Lists</h4>
                     <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Loan ID</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Status</th>
            <th>edit</th>
            <th>remove</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->loan_id }}</td>
                    <td>{{ $row->payment_date }}</td>
                    <td>{{ \App\Models\loan_repayment_method::where('id',$row->payment_method)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ number_format($row->amount,2) }}</td>
                    <td>
                    @if($row->status=='pending')
                        <span class="label label-warning">Pending</span>
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
                    <td><a href="{!! route('managepayment.edit', [$row->id])  !!}" class='ti ti-pencil-alt' title="Edit Info"></a></td>
                    <td>
                        {!! Form::open(['route' => ['managepayment.destroy', $row->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ti ti-close"></i>', ['type' => 'submit', 'onclick' => "return confirm('Are you sure, you want to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
                        
</div>          

</div>
</div>
</div>
                
@endsection

