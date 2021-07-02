@extends('layouts.app_admin')
@section('title', 'Manage security question')
@section('content')
    <section class="content-header">
        <h1>
            Manage security question
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['securityquestion.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('securityquestion.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection