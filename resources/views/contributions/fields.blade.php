<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('users', 'Contributor:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="contributor_id" name="contributor_id" required>
                <option value="">Choose contributor...</option>
                @foreach ($user as $row)
                    <option  value="{{ $row->id }}">{{ $row->name. ' - '.$row->reg_no }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Date:</label>

    <div class="col-sm-8 col-xs-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
            <input type="text" class="form-control datepicker" name="payment_date" value="{{ date('Y-m-d') }}" >
        </div>
        <span class="help-block"></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('bank', 'Bank:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="bank_id" name="bank_id">
                <option value="">Choose bank...</option>
                @foreach ($bank as $row)
                    <option  value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('users', 'Payment Method:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="payment_method_id" name="payment_method_id">
                <option value="">Choose payment method...</option>
                @foreach ($paymentmethod as $row)
                    <option   value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('amount', 'Amount Paid:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('amount', null, ['class' => 'form-control', 'required'=>'required']) !!}
</div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Remarks:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
    </div>
</div>


</br></br>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('contributions.index') !!}" class="btn btn-warning">Back</a>
</div>
</div>

</div>