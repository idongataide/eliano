<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('loan', 'Loan:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="laon_id" name="laon_id" required>
                <option value="">Choose payment method...</option>
                @foreach ($loan as $row)
                    <option  {{ ($row->id == $data->loan_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('payment_method', 'Payment Method:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="">Choose payment method...</option>
                @foreach ($payment_method as $row)
                    <option  {{ ($row->id == $data->payment_method)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
<label class="col-md-4 col-xs-12 control-label">Payment Date:</label>
<div class="col-sm-8 col-xs-12">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
        <input type="text" class="form-control datepicker" required name="payment_date" value="{{ $data->payment_date }}" >
    </div>
    <span class="help-block"></span>
</div>
</div>
<div class="form-group">
    {!! Form::label('amount', 'Amount Paid:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('amount', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">  
    <label for="teller" class="col-sm-3 control-label">Teller/Remarks:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('teller', null, ['class' => 'form-control', 'placeholder' => 'enter teller no or payment remark']) !!}
    </div>
</div>





<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Upload Proof of Payment:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="pop" id="pop" title="Browse file"/>
    </div>
</div>


<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managepayment.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>