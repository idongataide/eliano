@extends('layouts.app_admin')
@section('title', 'manage plan')
@section('content')
    <section class="content-header">
        <h1>
            Manage plan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['manageplan.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('manageplan.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection