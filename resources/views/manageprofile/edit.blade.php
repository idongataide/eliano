@extends('layouts.app_admin')
@section('title', 'Manage Profile')
@section('content')
    <section class="content-header">
        <h1>
            Manage Profile
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
                   {!! Form::model($profile, ['route' => ['manageprofile.update', $profile->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('manageprofile.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection