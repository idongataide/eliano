@section('title', 'manage admin user')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
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
                    <td>{{ $row->phonenumber }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->rolename }}</td>
                    @if($row->status == 1)
                    <td><span class="badge bg-success">active</span></td>
                    @else
                    <td><span class="badge bg-danger">blocked</span></td>
                    @endif
                    <td><a href="{!! route('adminusers.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route' => ['adminusers.destroy', $row->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to blocked or unblocked this user?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


