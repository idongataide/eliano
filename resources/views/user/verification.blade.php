@extends('layouts.user')
@section('title', 'verification')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">USER VERIFICATION</span></h2>
        <p>Let complete your registration process, user verification makes you eligible to collect loan</p>
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


        @if(Auth::user()->email_verify == 0)

        <div class="status status-warnning">
        <div class="status-icon">
            <em class="ti ti-files"></em>
            <div class="status-icon-sm">
                <em class="ti ti-alert"></em>
            </div>
        </div>
        <span class="status-text">To confirm your email, go to your mail inbox or spam to copy the code we sent to you.</span>
        


        <ul class="list list-sm list-checked">
                <form  action="{{route('user.sendemailcode') }}" method="post">
                {!! csrf_field() !!}
                    <li>No code? 
                    <span>
                        <button type="submit" class="badge btn-primary">Resend Code</button>
                    </form>
                    </span>
                </li>
                    <br>
                <form  action="{{route('user.email-verify') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                    <div class="col-md-12">
                     <div class="input-item input-with-label">
                        <input class="input-bordered" placeholder="paste the code here" type="text" id="email_code" name="email_code">
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Verify</button>
                </ul>              
                </form>
                </div>


        @elseif(Auth::user()->phone_verify == 0)

        <div class="status status-warnning">
        <div class="status-icon">
            <em class="ti ti-files"></em>
            <div class="status-icon-sm">
                <em class="ti ti-alert"></em>
            </div>
        </div>
        <span class="status-text">To confirm your phone number, check  message box and copy the code sent to you.</span>
         <ul class="list list-sm list-checked">
                <form  action="{{route('user.post-sms-code') }}" method="post">
                {!! csrf_field() !!}
                    <li>No code? 
                    <span>
                        <button type="submit" class="badge btn-primary">Resend Code</button>
                    </form>
                    </span>
                </li>
                    <br>
                <form  action="{{route('user.phone-verify') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                    <div class="col-md-12">
                     <div class="input-item input-with-label">
                        <input class="input-bordered" placeholder="paste the code here" type="text" id="phone_code" name="phone_code">
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Verify</button>
                </ul>              
                </form>
                </div>

        @elseif(Auth::user()->kyc_verify == 0)
            @if($credential != null)
            <div class="status status-process">
                <div class="status-icon">
                    <em class="ti ti-files"></em>
                    <div class="status-icon-sm">
                        <em class="ti ti-alarm-clock"></em>
                    </div>
                </div>
                <span class="status-text">Thank you! You have completed the process for your Identity verification.</span>
                <p>We are still working on your identity verification. Once our team verified your indentity, you will be whitelisted and notified by email.</p>
            </div>
            @else
            @include('user.include.kyc')
            @endif
        @endif

    </div>
    </div>
</div>
    
@endsection