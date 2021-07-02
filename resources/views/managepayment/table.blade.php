@section('title', 'manage payment')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="data-table" class="table table-striped table-condensed table-hover refferal-table">
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
                    <td><a href="{{ route('user.loan.details',[$row->loan_id]) }}">{{ $row->loan_id }}</a></td>
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
                    <td class="tranx-action">
                        <a href="{!! route('managepayment.edit', [$row->id])  !!}" title="Edit Info"><em class="ti ti-more-alt"></em></a>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['managepayment.destroy', $row->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


