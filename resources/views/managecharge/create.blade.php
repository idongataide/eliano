@extends('layouts.app_admin')
@section('title', 'manage charge')
@section('content')
    <section class="content-header">
        <h1>
            New Charge
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'managecharge.store','files' => true]) !!}

                        @include('managecharge.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
