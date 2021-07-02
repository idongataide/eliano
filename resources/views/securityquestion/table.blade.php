@section('title', 'Manage security question')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Question</th>
            <th>Posted By</th>
            <th>Last Update Date</th>
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
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td><a href="{!! route('securityquestion.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route' => ['securityquestion.destroy', $row->id], 'method' => 'delete']) !!}
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


