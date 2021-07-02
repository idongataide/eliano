<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('amount', 'Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('amount', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('charge_type', 'Charge Type:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="charge_type" name="charge_type" required>
                <option value="">Choose charge type...</option>
                @foreach ($charge_type as $row)
                    <option {{ ($row->code == $data->charge_type)? 'selected':'' }}  value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('charge_option', 'Charge Option:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="charge_option" name="charge_option" required>
                <option value="">Choose charge option...</option>
                @foreach ($charge_option as $row)
                    <option  {{ ($row->code == $data->charge_option)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="penalty" id="penalty" {{$data->penalty == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Penalty</label>
        </div>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="overide" id="overide" {{$data->overide == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Overide</label>
        </div>
    </div>
</div>



<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managecharge.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>