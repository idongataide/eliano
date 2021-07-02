@extends('layouts.app_admin')
@section('title', 'Manage FAQ')
@section('content')
    <section class="content-header">
        <h1>
            Manage FAQ
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['faq.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('faq.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection