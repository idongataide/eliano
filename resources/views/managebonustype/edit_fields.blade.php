<div class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
    {!! Form::label('category', 'Category:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
            <select class="form-control" id="category" name="category" required>
                <option value="">Choose category...</option>
                @foreach ($category as $row)
                    <option  {{ ($row->code == $data->category)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
          </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('amount', 'Amount:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::number('amount', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managebonustype.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>