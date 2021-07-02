<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('nationality', 'Nationality:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('nationality', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('sort_order', 'Sort Order:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('sort_order', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('country.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>