
@extends('layouts.account')
@section('title', 'Change Password')
@section('content')
<div class="ath-body">
    <h5 class="ath-heading title">Change <small class="tc-default">Password</small></h5>
    <form method="post" action="{{ route('user.password.request') }}">
            {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{$email}}" class="input-field" placeholder="Email Address" hidden>
        
        <div class="field-item">
            <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="input-bordered" name="password" value="{{ old('password') }}" placeholder="New Password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="input-bordered" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmed Password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-md">Change Password</button>
    </form>
</div>
<div class="ath-note text-center tc-light">
    Remembered? <a href="{{url('/')}}"> <strong>Signin</strong></a>
</div>
@endsection
