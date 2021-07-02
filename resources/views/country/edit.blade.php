@extends('layouts.app_admin')
@section('title', 'manage country')
@section('content')
    <section class="content-header">
        <h1>
            Manage Country
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['country.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('country.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection