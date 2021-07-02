@extends('layouts.app_admin')
@section('title', 'Manage Settings')
@section('content')
    <section class="content-header">
        <h1>
            Manage Settings
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($company, ['route' => ['managecompany.update', $company->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('managecompany.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection