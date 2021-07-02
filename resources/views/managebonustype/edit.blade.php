@extends('layouts.app_admin')
@section('title', 'manage bonus types')
@section('content')
    <section class="content-header">
        <h1>
            Manage Bonus Types
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['managebonustype.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('managebonustype.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection