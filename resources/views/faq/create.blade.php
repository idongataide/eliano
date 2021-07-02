@extends('layouts.app_admin')
@section('title', 'manage faq')
@section('content')
    <section class="content-header">
        <h1>
            New faq
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'faq.store','files' => true]) !!}

                        @include('faq.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
