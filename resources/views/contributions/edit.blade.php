@extends('layouts.app_admin')
@section('title', 'Manage Contribution')
@section('content')
    <section class="content-header">
        <h1>
           Manage Contribution
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['contributions.update', $data->id], 'method' => 'patch','files' => true]) !!}

                        @include('contributions.fields_edit')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection