<div class="form-horizontal">
<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
{!! Form::label('name', 'Old Password:',['class' => 'col-sm-3 control-label']) !!}
<div class="col-sm-8">
    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
     @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
</div>


<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
{!! Form::label('name', 'New Password:',['class' => 'col-sm-3 control-label']) !!}
<div class="col-sm-8">
    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
      @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
{!! Form::label('name', 'Confirmed Password:',['class' => 'col-sm-3 control-label']) !!}
<div class="col-sm-8">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
    
    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>
</div>

</br>



<div class="form-group">
    {!! Form::label('fname', 'First Name:',['class' => 'col-sm-3 control-label']) !!}
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
    {!! Form::label('phone', 'Phone Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('phonenumber', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('email', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>




</br>

<!-- Submit Field -->
<div class="form-group">
 <div class="col-sm-offset-3 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('dashboard.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>
</div>