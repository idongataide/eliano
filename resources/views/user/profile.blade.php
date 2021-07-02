@extends('layouts.user')
@section('title', 'Profile')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">PROFILE</span></h2>
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


        @include('user.include.profile')
</div>
</div>
</div>
@endsection