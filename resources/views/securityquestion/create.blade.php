@extends('layouts.app_admin')
@section('title', 'manage security question')
@section('content')
    <section class="content-header">
        <h1>
            New security question
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'securityquestion.store','files' => true]) !!}

                        @include('securityquestion.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
