@extends('layouts.app_admin')
@section('title', 'Manage Repayment Details')
@section('content')
    <section class="content-header">
        <h1>
            Manage Repayment Details
        </h1>
   </section>
   <div class="content">
   <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
               {!! Form::open(['route' => 'postrepaymentdetails','files' => true]) !!}
               <div class="form-horizontal">
               <div class="form-group">
                    {!! Form::label('loan_id', 'Loan:',['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                            <select class="form-control" id="loan_id" name="loan_id">
                                <option value="">Choose loan...</option>
                                @foreach($loan as $row)
                                    <option {{ ($row->id == $data->loan_id)? 'selected':'' }}  value="{{ $row->id }}">{{\App\Models\loan_product::where('id',$row->loan_product_id)->select('name')->pluck('name')->first() }} - {{$row->id}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('payment_method', 'Payment Method:',['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                            <input type="hidden" id="payment_id" name="payment_id" value="{{$data->id}}">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option value="">Choose payment method...</option>
                                @foreach($payment_method as $row)
                                    <option {{ ($row->id == $data->payment_method)? 'selected':'' }}   value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>

                <div class="form-group">
                <label class="col-sm-3 control-label">Payment Date:</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                        <input type="text" class="form-control datepicker" name="payment_date" value="{{ $data->payment_date }}" >
                    </div>
                    <span class="help-block"></span>
                </div>
               </div>

                <div class="form-group">
                    {!! Form::label('Amount', 'Amount Paid:',['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::number('amount',$data->amount, array('class' => 'form-control', 'placeholder'=>"",'id'=>'amount', 'name'=>'amount')) !!}
                    </div>
                </div>


                <div class="form-group">  
                    <label for="remark" class="col-sm-3 control-label">Teller:</label>
                    <div class="col-sm-8">       
                        {!! Form::textarea('teller', $data->teller, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pop', 'Proof of Payments:',['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                        <img class="d-block mx-auto mb-3" src="{{ asset('/images/payment/') .'/'. $data->pop }}" alt="Image" width="250" height="150">
                        </div>
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status:',['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                            <select class="form-control" id="status_id" name="status_id" requrired>
                                <option value="">Choose payment status...</option>
                                @foreach($status as $row)
                                    <option {{ ($row->code == $data->status)? 'selected':'' }}   value="{{ $row->code }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="form-group">  
                    <label for="remark" class="col-sm-3 control-label">Remarks:</label>
                    <div class="col-sm-8">       
                        {!! Form::textarea('remark', $data->remark, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Save Payment', ['class' => 'btn btn-success']) !!}
                        <a href="{!! route('admin.loan.repayment') !!}" class="btn btn-warning">Back</a>
                    </div>
                 </div>
                </div>
            </div>
            {!! Form::close() !!}
       </div>
    </div>
   </div>
@endsection