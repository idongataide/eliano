<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Sender:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Message:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Remark:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
 <div class="col-sm-offset-3 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managecontactus.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>