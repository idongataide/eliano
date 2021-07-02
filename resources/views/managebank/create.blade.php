@extends('layouts.app_admin')
@section('title', 'manage bank')
@section('content')
    <section class="content-header">
        <h1>
            New Bank
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'managebank.store','files' => true]) !!}

                        @include('managebank.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
