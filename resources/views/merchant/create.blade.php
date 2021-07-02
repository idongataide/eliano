@extends('layouts.app_admin')
@section('title', 'New Merchant')
@section('content')
    <section class="content-header">
        <h1>
            Merchant
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'merchant.store','files' => true]) !!}

                        @include('merchant.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
