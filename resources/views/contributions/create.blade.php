@extends('layouts.app_admin')
@section('title', 'New Contribution')
@section('content')
    <section class="content-header">
        <h1>
            Contribution
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'contributions.store','files' => true]) !!}

                        @include('contributions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
