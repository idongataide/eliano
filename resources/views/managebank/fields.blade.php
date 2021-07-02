<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('code', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managerate.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>