@extends('layouts.app_admin')
@section('title', 'Manage Users Priviledge')
@section('content')
    <section class="content-header">
        <h1>
            New User Priviledge
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'priviledge.store']) !!}

                        @include('priviledge.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
