@extends('layouts.app_admin')
@section('title', 'Manage Contributor')
@section('content')
    <section class="content-header">
        <h1>
           Manage Contributor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['contributor.update', $user->id], 'method' => 'patch','files' => true]) !!}

                        @include('contributor.fields_edit')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection