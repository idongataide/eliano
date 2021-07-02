<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Role</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <?php $role = App\Models\Role::find($user->role_id)  ?>
            <td>{!! $role->name !!}</td>
                <td>                    
                    <div class='btn-group'>
                        <a href="{!! url('users/assign/create', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>                        
                    </div>
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
