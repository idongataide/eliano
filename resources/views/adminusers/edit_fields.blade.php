<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('username', 'Username:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('username', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('email', 'Email:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('email', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('password', 'Password:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('phone', 'Phone:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('phonenumber', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('role_id', 'Role:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="roleid" name="roleid" required>
                <option value="">Choose role...</option>
                @foreach ($role as $row)
                    <option  {{ ($row->id == $data->roleid)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<br><br>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('adminusers.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>