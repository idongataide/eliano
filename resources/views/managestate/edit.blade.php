@extends('layouts.app_admin')
@section('title', 'manage state')
@section('content')
    <section class="content-header">
        <h1>
            Manage State
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['managestate.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('managestate.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection