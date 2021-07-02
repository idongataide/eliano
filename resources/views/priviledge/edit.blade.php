@extends('layouts.app_admin')
@section('title', 'Manage Album')
@section('content')
    <section class="content-header">
        <h1>
            Manage Album
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($album, ['route' => ['album.update', $album->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('album.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection