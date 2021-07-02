@extends('layouts.app_admin')
@section('title', 'Manage Contact Us')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Manage Contact Us</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('managecontactus.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
                
@endsection

