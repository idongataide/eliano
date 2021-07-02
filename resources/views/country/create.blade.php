@extends('layouts.app_admin')
@section('title', 'manage country')
@section('content')
    <section class="content-header">
        <h1>
            New Country
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'country.store','files' => true]) !!}

                        @include('country.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
