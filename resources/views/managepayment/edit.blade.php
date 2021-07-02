@extends('layouts.user')
@section('title', 'manage payment')
@section('content')
    <div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">MODIFY PAYMENT</span></h2>
        
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('danger') }}
            </div>
        @endif

        <div class="user-kyc">
        {!! Form::model($data, ['route' => ['managepayment.update', $data->id], 'method' => 'patch', 'files' => true]) !!}

            @include('managepayment.edit_fields')

        {!! Form::close() !!}
        </div>
</div>
</div>
</div>                  
@endsection