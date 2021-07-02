@extends('layouts.app_admin')
@section('title', 'Merchant')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Merchant</h1>
        <div class="text-right">
           <a  class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('merchant.create') }}">New Merchant</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('merchant.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

