<div class="form-horizontal">
<div class="form-group">
{!! Form::label('admin_image', 'Photo:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/users/') .'/'. $user->user_img }}" alt="Image" width="100" height="100">
    </div>
</div>

<div class="form-group">
    {!! Form::label('referby', 'Merchant:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="referby" name="referby">
                <option value="">Choose merchant...</option>
                @foreach ($merchant as $row)
                    <option   {{ ($row->id == $user->referby)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name. ' - '.$row->reg_no }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Contributor Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('reg_no', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('name', 'First Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('fname', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('lname', 'Last Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('lname', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('email', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('username', 'Username:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('username', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('phonenumber', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="gender" name="gender">
                <option value="">Choose gender...</option>
                @foreach ($gender as $row)
                    <option  {{ ($row->id == $user->gender)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">  
    <label for="location" class="col-sm-3 control-label">Location:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('location', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="business_address" class="col-sm-3 control-label">Business Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('business_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('plan', 'Contribution Plan:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="plan_id" name="plan_id">
                <option value="">Choose contrbution plan...</option>
                @foreach ($plan as $row)
                    <option  {{ ($row->id == $user->plan_id)? 'selected':'' }}  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('duration', 'Duration:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('plan_duration', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('plan_contribution_amount', 'Contribution Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('plan_contribution_amount', null, ['class' => 'form-control']) !!}
</div>
</div>





<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Change Contributor Picture:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="img" id="img" title="Browse file"/>
    </div>
</div>

</br></br>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('contributor.index') !!}" class="btn btn-warning">Back</a>
</div>
</div>

</div>