<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('country_id', 'Country:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="country_id" name="country_id" required>
                <option value="">Choose Country...</option>
                @foreach ($country as $row)
                    <option  {{ ($row->id == $data->country_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
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
    <a href="{!! route('managestate.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>