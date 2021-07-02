@extends('layouts.app_admin')
@section('title', 'manage bonus type')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Manage bonus type</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('managebonustype.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
                
@endsection

