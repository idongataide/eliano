@section('title', 'Manage Users Priviledge')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Role</th>
            <th>Priviledge</th>
            <th>revoke</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->role_name }}</td>
                    <td>{{ $row->priviledge_name }}</td>
                    <td>
                        {!! Form::open(['route' => ['priviledge.destroy', $row->id], 'method' => 'delete']) !!}
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


