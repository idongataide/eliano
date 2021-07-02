<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('duration', 'Duration:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('duration', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('mininum_loan_amount', 'Minimum Loan Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('mininum_loan_amount', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('contribution_amount', 'Contribution Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('contribution_amount', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('manageplan.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>