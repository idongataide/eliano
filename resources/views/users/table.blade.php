@section('title', 'User')
<div class="table-responsive">
<table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>SN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Status</th>
                <th>action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $i=1  ?>
            @foreach($users as $user)
            <tr>
                <td>{!! $i++ !!}</td>
                <td>{!! $user->fname !!}</td>
                <td>{!! $user->lname !!}</td>
                <td>{!! $user->phonenumber !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->gendername !!}</td>
                @if($user->status == 1)
                <td><span class="badge bg-success">active</span></td>
                @else
                <td><span class="badge bg-danger">blocked</span></td>
                @endif

                <td>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{-- <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to blocked or unblocked this user?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
