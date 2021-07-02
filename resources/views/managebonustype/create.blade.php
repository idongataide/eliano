@extends('layouts.app_admin')
@section('title', 'manage city')
@section('content')
    <section class="content-header">
        <h1>
            New City
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'managecity.store','files' => true]) !!}

                        @include('managecity.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
