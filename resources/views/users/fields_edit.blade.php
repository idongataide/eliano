<div class="form-horizontal">
<div class="form-group">
{!! Form::label('admin_image', 'Photo:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/users/') .'/'. $user->user_img }}" alt="Image" width="100" height="100">
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
    {!! Form::label('dob', 'Date of Birth:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('dob', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('dob', 'Date Joined:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('created_at', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Contact Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('country_id', 'Country:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="country_id" name="country_id" required>
                <option value="">Choose country...</option>
                @foreach ($country as $row)
                    <option  {{ ($row->id == $user->country)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('state_id', 'State:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="state_id" name="state_id" required>
                <option value="">Choose state...</option>
                @foreach ($state as $row)
                    <option  {{ ($row->id == $user->state)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('city_id', 'City:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="city_id" name="city_id" required>
                <option value="">Choose city...</option>
                @foreach ($city as $row)
                    <option  {{ ($row->id == $user->city)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('current_work', 'Current Work:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('current_work', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('current_salary', 'Current Salary:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('current_salary', null, ['class' => 'form-control']) !!}
</div>
</div>

<hr>

<h3 style="text-align:center">BANK DETAILS</h3>
<div class="form-group">
    {!! Form::label('bank_id', 'Bank:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="bank_id" name="bank_id" required>
                <option value="">Choose bank...</option>
                @foreach ($bank as $row)
                    <option  {{ ($row->id == $user->bank_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('accountname', 'Account Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('accountname', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('account_no', 'Account Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('account_no', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('bvn', 'BVN:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('bvn', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<hr>
<h3 style="text-align:center">VERIFICATION</h3>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="email_verification" id="email_verification" {{$user->email_verify == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Email Verify</label>
        </div>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="bvn_verification" id="bvn_verification" {{$user->bvn_verify == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">BVN Verify</label>
        </div>
    </div>
</div>


<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="phone_verification" id="phone_verification" {{$user->phone_verify == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Phone Verify</label>
        </div>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="kyc_verification" id="kyc_verification" {{$user->kyc_verify == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">KYC Verify</label>
        </div>
    </div>
</div>


<hr/>

<h3 style="text-align:center">DOCUMENTS SUBMITTED</h3>

<hr/>

@if($passport != null)

<div class="form-group">
{!! Form::label('favicon', 'Passport:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/documents/') .'/'. $passport->image1 }}" alt="Image" width="250" height="150">
    </div>
</div>

@endif
@if($national_id != null)

<div class="form-group">
{!! Form::label('favicon', 'National ID Front:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/documents/') .'/'. $national_id->image1 }}" alt="Image" width="250" height="150">
    </div>
</div>

<div class="form-group">
{!! Form::label('favicon', 'National ID Back:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/documents/') .'/'. $national_id->image2 }}" alt="Image" width="250" height="150">
    </div>
</div>

@endif
@if($driver_license != null)
<hr/>

<div class="form-group">
{!! Form::label('favicon', 'Drivers Licence:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/documents/') .'/'. $driver_license->image1 }}" alt="Image" width="250" height="150">
    </div>
</div>

@endif

</br></br>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Approve KYC', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-warning">Back</a>
</div>
</div>

</div>