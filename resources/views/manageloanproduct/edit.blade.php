@extends('layouts.app_admin')
@section('title', 'manage loan products')
@section('content')
    <section class="content-header">
        <h1>
            Manage loan products
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['manageloanproduct.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('manageloanproduct.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection