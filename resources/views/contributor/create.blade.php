@extends('layouts.app_admin')
@section('title', 'New Contributor')
@section('content')
    <section class="content-header">
        <h1>
            Contributor
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'contributor.store','files' => true]) !!}

                        @include('contributor.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
