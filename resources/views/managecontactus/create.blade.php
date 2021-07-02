@extends('layouts.app_admin')
@section('title', 'manage contact us')
@section('content')
    <section class="content-header">
        <h1>
            Manage Contact us
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'faq.store','files' => true]) !!}

                        @include('managecontactus.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
