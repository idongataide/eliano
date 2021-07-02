
<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Type</th>
            <th>Option</th>
            <th>Penalty</th>
            <th>Overide</th>
            <th>Amount</th>
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
                    <td>{{  App\Models\charge_type::where('code',$row->charge_type)->select('name')->pluck('name')->first() }}</td>
                    <td>{{  App\Models\charge_option::where('code',$row->charge_option)->select('name')->pluck('name')->first() }}</td>
                    @if($row->penalty == 1)
                    <td><span class="badge bg-success">Yes</span></td>
                    @else
                    <td><span class="badge bg-warning">No</span></td>
                    @endif
                    @if($row->overide == 1)
                    <td><span class="badge bg-success">Yes</span></td>
                    @else
                    <td><span class="badge bg-warning">No</span></td>
                    @endif
                    <td>{{ number_format($row->amount,2) }}</td>
                    @if($row->active == 1)
                    <td><span class="badge bg-success">Active</span></td>
                    @else
                    <td><span class="badge bg-danger">In Active</span></td>
                    @endif
                    <td><a href="{!! route('managecharge.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route' => ['managecharge.destroy', $row->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to deactivate or activate this charge?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


