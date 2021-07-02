<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Title:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
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
                    <option  {{ ($row->code == $data->interest_method)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
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
                    <option  {{ ($row->code == $data->interest_period)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
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
                    <option  {{ ($row->code == $data->repayment_cycle)? 'selected':'' }} value="{{ $row->code }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>


<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="override_interest" id="override_interest" {{$data->override_interest == "1" ? 'checked' : '' }}>
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
            <input type="checkbox" class="custom-control-input" name="is_default" id="is_default" {{$data->is_default == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Is Default</label>
        </div>
    </div>
</div>




<hr>
<p class="text-center">Charge</p>

<div class="row">
<div class="panel-body">
<div class="form-group">
{!! Form::label('cha','Charge String',array('class'=>'col-sm-3 control-label')) !!}
<div class="col-sm-6">
<select class="form-control select2" id="charges_dropdown" name="charges_dropdown">
<option value="">Choose charge...</option>
@foreach ($charge as $row)
    <option  value="{{ $row->id }}">{{ $row->name }}</option>
@endforeach
</select>
</div>
<div class="col-sm-3">
    <button type="button" id="chargesAdd"  class="btn btn-primary pull-right">Add</button>
</div>
</div>
</div>


<div class="form-group" id="chargesDiv">
                <div style="display: none;" id="saved_charges">
                    @foreach($loan_product->charges as $key)
                        <input name="charges[]" id="charge{{$key->charge_id}}" value="{{$key->charge_id}}">
                    @endforeach
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Collected on</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="charges_table">
                    @foreach($loan_product->charges as $key)
                        @if(!empty($key->charge))
                            <tr id="row{{$key->charge->id}}">
                                <td>{{ $key->charge->name }}</td>
                                <td>
                                    {{$key->charge->amount}}
                                    {{ App\Models\charge_option::where('code',$key->charge->charge_option)->select('name')->pluck('name')->first() }}
                                </td>
                                <td>
                                {{App\Models\charge_type::where('code',$key->charge->charge_type)->select('name')->pluck('name')->first()}}
                                </td>
                                <td><button type="button" class="btn btn-danger btn-xs" data-id="{{$key->charge->id}}" onclick="deleteCharge(this)"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>

</div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save Loan Product', ['class' => 'btn btn-success']) !!}
        <a href="{!! route('manageloanproduct.index') !!}" class="btn btn-primary">Cancel</a>
    </div>
</div>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#chargesAdd').click(function (e) {
                if ($('#charges_dropdown').val() == "") {
                    swal({
                            title: 'Charge Required',
                            text: 'Charge Required',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok',
                            timer: 2000
                        })
                } else {
                    //try to build table
                    var id = $('#charges_dropdown').val();
                    $.ajax({
                        type: 'GET',
                        url: "{{url('admin/loan_product/get_charge_detail')}}" + "/" + id,
                        dataType: "json",
                        success: function (data) {
                            $('#charges_table').append('<tr id="row' + id + '"><td>' + data.name + '</td><td>' + data.amount + '</td><td>' + data.collected_on + '</td><td><button type="button" class="btn btn-danger btn-xs" data-id="' + id + '" onclick="deleteCharge(this)"><i class="fa fa-trash"></i></button></td></tr>');
                            $('#saved_charges').append('<input name="charges[]" id="charge' + id + '" value="' + id + '">');

                        },
                        error: function (data) {
                            swal({
                                title: 'Error',
                                text: 'An Error occurred, please try again',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok',
                                timer: 2000
                            })
                        }
                    });
                }

            });
        });
        function deleteCharge(e) {
            swal({
                title: 'Are you sure, you want to delete?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancel'
            }).then(function () {
                $('#charge' + $(e).attr("data-id")).remove();
                $('#row' + $(e).attr("data-id")).remove();

            })


        }
    </script>

