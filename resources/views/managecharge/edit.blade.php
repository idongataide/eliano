@extends('layouts.app_admin')
@section('title', 'manage charge')
@section('content')
    <section class="content-header">
        <h1>
            Manage Charge
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['managecharge.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('managecharge.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection