@extends('layouts.app_admin')
@section('title', 'Manage Contact Us')
@section('content')
    <section class="content-header">
        <h1>
            Manage Contact Us
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['managecontactus.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('managecontactus.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection