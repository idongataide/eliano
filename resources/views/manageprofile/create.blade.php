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
        <div class="box box-primary">
        @include('flash::message')
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'manageprofile.store']) !!}

                        @include('manageprofile.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
