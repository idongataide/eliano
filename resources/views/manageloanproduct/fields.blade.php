<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Title:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('minimum_principal', 'Minimum Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('minimum_principal', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('maximum_principal', 'Maximum Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('maximum_principal', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('rate', 'Point to Qualified:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('point', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('rate', 'Interest Rate:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('interest_rate', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('interest_method', 'Interest Method:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="interest_method" name="interest_method" required>
                <option value="">Choose interest method...</option>
                @foreach ($loan_interest_method_type as $row)
                    <option  value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('interest_period', 'Interest Period:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="interest_period" name="interest_period" required>
                <option value="">Choose interest period...</option>
                @foreach ($loan_period_type as $row)
                    <option  value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('repayment_cycle', 'Repayment Cycle:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="repayment_cycle" name="repayment_cycle" required>
                <option value="">Choose repayment cycle...</option>
                @foreach ($loan_repayment_type as $row)
                    <option  value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="override_interest" id="override_interest">
            <label class="custom-control-label" for="customSwitch3">Overide Interest</label>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('override_interest_amount', 'Override Interest Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('override_interest_amount', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="is_default" id="is_default">
            <label class="custom-control-label" for="customSwitch3">Is Default</label>
        </div>
    </div>
</div>
<div class="form-group">  
    <label for="sub_title" class="col-sm-3 control-label">Sub Title:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('sub_title', null, ['class' => 'form-control', 'placeholder' => 'sub title']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="description" class="col-sm-3 control-label">Description:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
    </div>
</div>
<br><br>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('manageloanproduct.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>