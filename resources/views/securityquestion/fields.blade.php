<div class="form-horizontal">

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Question:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('name', null, ['class' => 'form-control', 'placeholder' => 'enter your question']) !!}
    </div>
</div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('securityquestion.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>