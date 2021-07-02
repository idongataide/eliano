<div class="table-responsive">
<table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>SN</th>
                <th>Merchant Number</th>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Legal Status</th>
                <th>Status</th>
                <th>action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $i=1  ?>
            @foreach($users as $user)
            <tr>
                <td>{!! $i++ !!}</td>
                <td>{!! $user->reg_no !!}</td>
                <td>{!! $user->username !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->phonenumber !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! \App\Models\gender::where('id',$user->gender)->select('name')->pluck('name')->first() !!}</td>
                <td>{!! $user->dob !!}</td>
                <td>{!! \App\Models\legal_status::where('id',$user->legal_status_id)->select('name')->pluck('name')->first() !!}</td>
                @if($user->status == 1)
                <td><span class="badge bg-success">active</span></td>
                @else
                <td><span class="badge bg-danger">blocked</span></td>
                @endif
                <td>
                    {!! Form::open(['route' => ['merchant.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('merchant.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to blocked or unblocked this merchant?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
