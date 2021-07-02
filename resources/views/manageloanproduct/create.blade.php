@extends('layouts.app_admin')
@section('title', 'manage loan products')
@section('content')
    <section class="content-header">
        <h1>
            New Loan Product
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'manageloanproduct.store','files' => true]) !!}

                        @include('manageloanproduct.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

   
@endsection
