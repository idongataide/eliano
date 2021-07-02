@section('title', 'manage state')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Duration</th>
            <th>Mininum Loan Amount</th>
            <th>Contribution Amount</th>
            <th>Last Updated</th>
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
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->duration }}</td>
                    <td>{{ $row->mininum_loan_amount }}</td>
                    <td>{{ $row->contribution_amount }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td>
                    @if($row->status=='0')
                        <span class="label label-success">Active</span>
                    @endif
                    @if($row->status=='1')
                    <span class="label label-danger">Deactivated</span>
                    @endif
                    </td>
                    <td><a href="{!! route('manageplan.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route' => ['manageplan.destroy', $row->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


