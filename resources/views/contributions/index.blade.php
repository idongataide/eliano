@extends('layouts.app_admin')
@section('title', 'Contribution')
@section('content')
    <section class="content-header">
    <h1 class="pull-left">Contribution</h1>
    <div class="row">
    {!! Form::open(['route' => 'viewcontribution']) !!}
        <div class="col-lg-12">
            <div class="controls form-inline well">

            <div class="form-group">
                <label class="col-md-4 col-xs-12 control-label">Start Date:</label>
                <div class="col-sm-8 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                        <input type="text" class="form-control datepicker" required name="start_date" value="{{ $start_date }}" >
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 col-xs-12 control-label">End Date:</label>
                <div class="col-sm-8 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                        <input type="text" class="form-control datepicker" required name="end_date" value="{{ $end_date }}" >
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">View</button>
              </div>
            </div>

            {!! Form::close() !!}
        </div>
        <div class="text-right">
           <a  class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('contributions.create') }}">New Contribution</a>
        </div>
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
                    @include('contributions.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

