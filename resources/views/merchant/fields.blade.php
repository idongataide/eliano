<div class="form-horizontal">

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
    <label class="col-md-3 col-xs-12 control-label">Date of Birth:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="dob" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="gender" name="gender">
                <option value="">Choose gender...</option>
                @foreach ($gender as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('marital_status', 'Marital Status:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="marital_status_id" name="marital_status_id">
                <option value="">Choose marital status...</option>
                @foreach ($marital_status as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<div class="form-group">  
    <label for="business_address" class="col-sm-3 control-label">Business Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('business_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="address" class="col-sm-3 control-label">Home Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('home_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('legal_status', 'Legal Status:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="legal_status_id" name="legal_status_id">
                <option value="">Choose legal status...</option>
                @foreach ($legal_status as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('village', 'Village:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('village', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('country_id', 'Country:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="country" name="country">
                <option value="">Choose country...</option>
                @foreach ($country as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('state_id', 'State:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="state" name="state">
                <option value="">Choose state...</option>
                @foreach ($state as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('city_id', 'City:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="city" name="city">
                <option value="">Choose city...</option>
                @foreach ($city as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('type_of_id', 'Type of Identification:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('type_of_id', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('Identification_no', 'Identification Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('Identification_number', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date Issued:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="date_issued" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date of Expiry:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="date_of_expiry" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('establishment', 'Establishment/Employer/Business:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('establishment', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">  
    <label for="employer_address" class="col-sm-3 control-label">Employer's Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('employer_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="pep" id="pep">
            <label class="custom-control-label" for="customSwitch3">Is the Individual a Politically Important Person</label>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('regulatory_status', 'Regulatory Status:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('regulatory_status', null, ['class' => 'form-control']) !!}
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
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
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

<h3 style="text-align:center">NEXT OF KIN</h3>
<div class="form-group">
    {!! Form::label('kin_name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_name', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('kin_relationship', 'Relationship:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_relationship', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('kin_phone', 'Phone Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_phone', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('kin_email', 'Email:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_email', null, ['class' => 'form-control']) !!}
</div>
</div>



<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date of Birth:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="kin_dob" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('kin_gender', 'Gender:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="kin_gender" name="kin_gender">
                <option value="">Choose gender...</option>
                @foreach ($gender as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<div class="form-group">
    {!! Form::label('kin_id_type', 'Identification Type:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_id_type', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('kin_id_number', 'Identification Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_id_number', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">  
    <label for="employer_address" class="col-sm-3 control-label">Home Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('kin_home_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('kin_occupation', 'Occupation:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('kin_occupation', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">  
    <label for="occupation_address" class="col-sm-3 control-label">Occupation Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('kin_occupation_address', null, ['class' => 'form-control']) !!}
    </div>
</div>



<hr>

<h3 style="text-align:center">GUARANTOR</h3>
<div class="form-group">
    {!! Form::label('gar_name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_name', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gar_occupation', 'Occupation:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_occupation', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gar_position', 'Position/Level:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_position', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gar_relationship', 'Relationship:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_relationship', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gar_phone', 'Phone:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_phone', null, ['class' => 'form-control']) !!}
</div>
</div>


<div class="form-group">
    {!! Form::label('gar_gender', 'Gender:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="gar_gender" name="gar_gender">
                <option value="">Choose gender...</option>
                @foreach ($gender as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<div class="form-group">  
    <label for="gar_address" class="col-sm-3 control-label">Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('gar_address', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('gar_id_type', 'Identification Type:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_id_type', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('gar_id_number', 'Identification Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('gar_id_number', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date Issued:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="gar_date_issued" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date of Expiry:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="gar_date_of_expiry" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date of Signed:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="gar_date_signed" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>


<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Change Merchant Picture:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="img" id="img" title="Browse file"/>
    </div>
</div>

</br></br>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('merchant.index') !!}" class="btn btn-warning">Back</a>
</div>
</div>

</div>