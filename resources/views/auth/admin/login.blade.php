@extends('layouts.account')
@section('title', 'Admin Login')
@section('content')
<div class="ath-body">
    <h5 class="ath-heading title">Sign in <small class="tc-default"></small></h5>

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
    @if(Session::has('warning'))
        <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('warning') }}
        </div>
    @endif

    <form class="login-form" role="form" method="POST" action="{{ route('adminLoginPost') }}">
            {{ csrf_field() }}
        <div class="field-item {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}">
            <div class="field-wrap">
                <input type="text" class="input-bordered" placeholder="Your Email or Username" id="email" name="email" value="{{ old('username') ?: old('email') }}" required>
                @if ($errors->has('email') || $errors->has('username'))
                <span class="help-block">
                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="password" class="input-bordered" placeholder="Password" name="password" id="password" value="{{ old('password') }}" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center pdb-r">
            <div class="field-item pb-0">
                <input class="input-checkbox" id="remember-me-2" type="checkbox">
                <label for="remember-me-2">Remember Me</label>
            </div>
            <div class="forget-link fz-6">
                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#reset-popup">Forgot password?</a>
            </div>
        </div>
        <button class="btn btn-black btn-block btn-md">Sign In</button>
    </form>
    

<div class="modal fade" id="reset-popup">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close">
                <em class="ti ti-close"></em></a>
                <div class="ath-container m-0">
                    <div class="ath-body"><h5 class="ath-heading title">Reset <small class="tc-default">with your Email</small></h5>
                    <form method="POST" action="{{ route('user.password.email') }}">
                            {{ csrf_field() }}
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input type="email" name="email" value="{{ old('email') }}" class="input-bordered" placeholder="Your Email"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-md">Reset Password</button>
                                    <div class="ath-note text-center"> Remembered? 
                                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login-popup"> 
                                            <strong>Sign in here</strong>
                                        </a>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection