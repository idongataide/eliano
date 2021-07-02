@extends('layouts.account')
@section('title', 'Reset Password')
@section('content')
<div class="ath-body">
    <h5 class="ath-heading title">Reset <small class="tc-default">Password</small></h5>

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

    <form method="post" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}
        <div class="field-item">
            <div class="field-wrap {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="input-bordered" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-md">Reset Password</button>
    </form>
</div>
<div class="ath-note text-center tc-light">
    Remembered? <a href="{{url('/')}}"> <strong>Signin</strong></a>
</div>
@endsection

