@extends('layouts.app_admin')
@section('title', 'manage admin users')
@section('content')
    <section class="content-header">
        <h1>
            New User
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'adminusers.store','files' => true]) !!}

                        @include('adminusers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
