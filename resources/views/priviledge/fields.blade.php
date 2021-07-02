<div class="form-horizontal">

<!-- artist Field -->
<div class="form-group">
        {!! Form::label('role_id', 'Role:',['class' => 'col-sm-3 control-label']) !!}
     <div class="col-sm-8">
       {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}     
    </div>
</div>
<!-- artist Field -->
<div class="form-group">
        {!! Form::label('priviledge_id', 'Priviledge:',['class' => 'col-sm-3 control-label']) !!}
     <div class="col-sm-8">
       {!! Form::select('priviledge_id', $priviledges, null, ['class' => 'form-control']) !!}     
    </div>
</div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('priviledge.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>