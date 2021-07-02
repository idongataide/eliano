@extends('layouts.app_admin')
@section('title', 'manage plan')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Manage plan</h1>
        <div class="text-right">
           <a  class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('manageplan.create') }}">New plan</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('manageplan.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
                
@endsection
