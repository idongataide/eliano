<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('title', 'Title:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Company Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'you can enter deescription with html tag like <p>,<br> etc']) !!}
    </div>
</div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('faq.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>