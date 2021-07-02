@extends('layouts.app_admin')
@section('title', 'manage state')
@section('content')
    <section class="content-header">
        <h1>
            New State
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'managestate.store','files' => true]) !!}

                        @include('managestate.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
