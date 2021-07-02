


@section('title', 'manage loan product')
<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Title</th>
            <th>Min Amt.</th>
            <th>Max Amt.</th>
            <th>Interest Rate</th>
            <th>Interest Method</th>
            <th>Repayment Cycle</th>
            <th>Interest Period</th>
            <th>Qualified Point</th>
            <th>Default</th>
            <th>Status</th>
            <th>edit</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ number_format($row->minimum_principal,2) }}</td>
                    <td>{{number_format( $row->maximum_principal,2) }}</td>
                    <td>{{ $row->interest_rate }}</td>
                    <td>{{ App\Models\loan_interest_method_type::where('code',$row->interest_method)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ App\Models\loan_repayment_type::where('code',$row->repayment_cycle)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ App\Models\loan_period_type::where('code',$row->interest_period)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ $row->point }}</td>
                    @if($row->is_default == 1)
                    <td><span class="badge bg-success">Yes</span></td>
                    @else
                    <td><span class="badge bg-warning">No</span></td>
                    @endif
                    @if($row->status == 1)
                    <td><span class="badge bg-success">Active</span></td>
                    @else
                    <td><span class="badge bg-danger">In Active</span></td>
                    @endif
                    <td><a href="{!! route('manageloanproduct.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route' => ['manageloanproduct.destroy', $row->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to deactivate or activate this loan product?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


