@extends('layouts.app_admin')
@section('title', 'manage plan')
@section('content')
    <section class="content-header">
        <h1>
            New plan
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'manageplan.store','files' => true]) !!}

                        @include('manageplan.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
