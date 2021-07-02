@extends('layouts.app_admin')
@section('title', 'manage engine types')
@section('content')
    <section class="content-header">
        <h1>
            New Engine Types
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'engine_type.store','files' => true]) !!}

                        @include('engine_type.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
