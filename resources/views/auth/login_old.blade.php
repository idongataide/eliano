<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>Tunezjam - Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="{{config('app.developer','Ime Iteh')}}"/>

    <link rel="icon" href="{{asset('/images/favicon.ico')}}" type="image/x-icon"/>
<!-- END META SECTION -->

<!-- CSS INCLUDE -->
<link rel="stylesheet" type="text/css" id="theme" href="{{asset('backend/css/design-sheet.css')}}"/>

<link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/app.css')}}"/>

</head>
<body>

    
        <div class="login-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default login-box">
                            
                            <div class="panel-body">
                                <form class="form" role="form" method="POST" action="{{ url('/login') }}">
                                    {{ csrf_field() }}
            
                                    <div class="form__group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" class="form__input" placeholder="Email Address" id="email" required name="email" value="{{ old('email') }}">
                                            <label for="email" class="form__label">Email Address</label>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
            
                                  
            
                                    <div class="form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" class="form__input" placeholder="Password" id="password" required name="password">
                                            <label for="password" class="form__label">Password</label>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
            
            
                                    <div class="form__group checkbox">
                                        
                                            <div class="checkbox">
                                                <label class="form-label">
                                                    <input type="checkbox" name="remember"> Remember Me
                                                </label>                          
                                                <button type="submit" class="btn btn--green">
                                                        Login
                                                    </button>                     
                                            
                                            </div>

                                            
                                    </div>
            
                                  

                                    <div class="form__group">                                       
                                           
            
                                            <a class="btn-text" href="#">
                                                Forgot Your Password?
                                            </a>

                                            {{-- <a class=" btn-text" href="#">
                                                Don't have an account?
                                             </a> --}}
                                       
                                    </div>
            
                                   
            
                            
            
                                       
                                </form>
                            </div>
                        </div>
                        {{-- <p class="login-footer"><small>Powered by <a href="http://tunezjam.com/" target="_blank">Geitel Solutions</a></small></p> --}}
                    </div>
            
                   
                </div>
            </div>



</body>
</html>
