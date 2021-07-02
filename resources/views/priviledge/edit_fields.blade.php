<div class="form-horizontal">
<div class="form-group">
{!! Form::label('name', 'Image:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/albums/') .'/'. $album->cover_url }}" alt="Image" width="170" height="170">
    </div>
</div>


<!-- received by Field -->
<div class="form-group">
    {!! Form::label('title', 'Album Title:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
</div>

<!-- artist Field -->
<div class="form-group">
        {!! Form::label('album_type', 'Category:',['class' => 'col-sm-3 control-label']) !!}
     <div class="col-sm-8">
       {!! Form::select('category_id', $album_types, null, ['class' => 'form-control']) !!}     
    </div>
</div>

<!-- received by Field -->
<div class="form-group">
    {!! Form::label('released_year', 'Released Year:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('released_year', null, ['class' => 'form-control']) !!}
</div>
</div>

<!-- received by Field -->
<div class="form-group">
    {!! Form::label('released_date', 'Released Date:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('released_date', null, ['class' => 'form-control datepicker']) !!}
</div>
</div>

<!-- artist Field -->
<div class="form-group">
        {!! Form::label('artist_id', 'Artist:',['class' => 'col-sm-3 control-label']) !!}
     <div class="col-sm-8">
       {!! Form::select('artist_id', $artist, null, ['class' => 'form-control']) !!}     
    </div>
</div>

<!-- Is Publish -->
<div class="form-group">
    {!! Form::label('IsPublished', 'Published:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::checkbox('ispublished',null, $ispublished) !!}
</div>
</div>

<!-- received by Field -->
<div class="form-group">
    {!! Form::label('sort_order', 'Sort Order:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('sort_order', null, ['class' => 'form-control']) !!}
</div>
</div>


<div class="form-group">
    {!! Form::label('description', 'Description:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter album info']) !!}
</div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Upload Image:</label>

    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="photo" id="photo" title="Browse file"/>
    </div>
</div>
<!-- artist Field -->
<div class="form-group">
        {!! Form::label('posted_by', 'Posted By:',['class' => 'col-sm-3 control-label']) !!}
     <div class="col-sm-8">
       {!! Form::select('posted_by', $users, null, ['class' => 'form-control']) !!}     
    </div>
</div>
<!-- received by Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created Date:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('created_at',null, ['class' => 'form-control datepicker']) !!}
</div>
</div>
<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('album.index') !!}" class="btn btn-default">Cancel</a>
</div>
</div>

</div>