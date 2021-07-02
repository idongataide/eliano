<div class="form-horizontal">

<div class="col-md-12">
<div class="input-item input-with-label">
    <label for="loan" class="input-item-label">Loan</label>
    <select class="country-select" name="loan_id" id="loan_id" required>
        <option value="">--select loan --</option>
        @foreach($loan as $row)
        <option  value="{{ $row->id }}">{{\App\Models\loan_product::where('id',$row->loan_product_id)->select('name')->pluck('name')->first() }} - {{$row->id}}</option>
        @endforeach
    </select>
</div><!-- .input-item -->
</div><!-- .col -->

<div class="col-md-12">
<div class="input-item input-with-label">
    <label for="loan" class="input-item-label">Payment Method</label>
    <select class="country-select" name="payment_method" id="payment_method" required>
        <option value="">--select payment method --</option>
        @foreach($payment_method as $row)
        <option  value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div><!-- .input-item -->
</div><!-- .col -->


<div class="col-md-12">
    <div class="input-item input-with-label">
        <input type="hidden" id="website" name="website" value="{{$basic->website}}">
        <label for="date-of-birth" class="input-item-label">Payment Date</label>
        <input class="input-bordered date-picker" type="text" value="{{ date('Y-m-d') }}" id="payment_date" name="payment_date" required>
    </div><!-- .input-item -->
</div><!-- .col -->

<div class="col-md-12">
    <div class="input-item input-with-label">
        <label for="first-name" class="input-item-label">Amount</label>
        {!! Form::number('amount',0, array('class' => 'input-bordered', 'placeholder'=>"",'required'=>'required','id'=>'amount', 'name'=>'amount')) !!}
    </div><!-- .input-item -->
</div><!-- .col -->

<div class="col-md-12">
    <div class="input-item input-with-label">
        <label for="description" class="input-item-label">Teller/Remarks:</label>
        <textarea class="input-bordered" name="teller" id="teller"></textarea>
    </div><!-- .input-item -->
</div><!-- .col -->

<div class="form-group">
<label for="description" class="input-item-label">Upload Proof of Payment:</label>
   <input type="file" class="fileinput input-bordered" name="pop" id="pop" title="Browse file"/>
</div>


<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('managepayment.index') !!}" class="btn btn-warning">Cancel</a>
</div>
</div>

</div>