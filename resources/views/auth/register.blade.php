@extends('layouts.account')
@section('title', 'Signup')
@section('content')
<div class="ath-body">
    <h5 class="ath-heading title">Signup <small class="tc-default">Create New Account</small></h5>
    
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
    @if(Session::has('info'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('info') }}
        </div>
    @endif
       <form method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <div class="field-item">
            <div class="field-wrap">
                 <input name="referby" hidden readonly  @if(isset($reference)) value="{{$reference}}"  @endif class="input-bordered" placeholder="">
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="text" class="input-bordered" value="{{ old('fname') }}" placeholder="First Name" name="fname" required id="fname">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('fname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="text" class="input-bordered" value="{{ old('lname') }}" placeholder="Last Name" name="lname" required id="lname">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('lname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="text" class="input-bordered" value="{{ old('phonenumber') }}" placeholder="Phone Number" name="phonenumber" required id="phonenumber">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('phonenumber'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phonenumber') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="text" class="input-bordered" value="{{ old('username') }}" placeholder="Username" name="username" required id="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="field-item">
            <div class="field-wrap">
                <input type="text" class="input-bordered" value="{{ old('email') }}" placeholder="Email" name="email" required id="email">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="field-item">
            <div class="field-wrap">
                <input type="password" value="{{ old('password') }}" class="input-bordered" placeholder="Password" name="password" id="password" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="field-item">
            <div class="field-wrap">
                <input type="password" value="{{ old('password_confirmation') }}" class="input-bordered" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span id='message'></span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="field-item">
            <div class="field-wrap">
            <select class="form-control" id="plan_id" name="plan_id" required>
                        <option value="">Choose contribution plan...</option>
                        @foreach ($plan as $row)
                            <option  value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                </select>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('plan_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('plan_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        

        <div class="field-item">
            <input class="input-checkbox" id="agree-term-2" type="checkbox">
            <label for="agree-term-2">I agree to {{$basic->name_prefix}} <a href="{{url('privacy-policy')}}">Privacy Policy</a> &amp; <a href="{{url('tc')}}">Terms</a>.</label>
        </div>
        <button class="btn btn-black btn-block btn-md">Sign Up</button>
    </form>
    <div class="sap-text"><span>Or Sign in</span></div>
    Don’t have an account? <a href="{{ url('login') }}"> <strong>Signin</strong></a>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$('#password, #password_confirmation').on('keyup', function() {
  if ($('#password').val() == $('#password_confirmation').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else
    $('#message').html('Not Matching').css('color', 'red');
});
</script>
@endsection