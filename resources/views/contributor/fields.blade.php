<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('referby', 'Merchant:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="referby" name="referby">
                <option value="">Choose merchant...</option>
                @foreach ($merchant as $row)
                    <option  value="{{ $row->id }}">{{ $row->name. ' - '.$row->reg_no }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('plan', 'Contribution Plan:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="plan_id" name="plan_id">
                <option value="">Choose contrbution plan...</option>
                @foreach ($plan as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
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
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">  
    <label for="business_address" class="col-sm-3 control-label">Location:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('location', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Contributor's Picture:</label>
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