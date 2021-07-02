<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{$basic->name}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Ime Iteh">
        <meta name="keywords" content="loan" />
       
        <link rel="shortcut icon" href="{{ asset('/images/') .'/'. $basic->favicon }}">

        <link rel="stylesheet" href="{{ asset('main/assets/css/vendor.bundle.css?ver=192') }}">
        
        <link rel="stylesheet" href="{{ asset('main/assets/css/style.css?ver=192') }}" id="changeTheme">
  
        <link rel="stylesheet" type="text/css" id="theme1" href="{{asset('css/required.css')}}"/> 
        <!-- Extra CSS -->
        <link rel="stylesheet" href="{{ asset('main/assets/css/theme.css?ver=192') }}">
        
    </head>

    <body class="nk-body body-wider  bg-light-alt">
	    <div class="nk-wrap">
            <main class="nk-pages nk-pages-centered bg-theme-img">
                    <div class="ath-container">
                        <div class="ath-header text-center">
                            <a href="{{ url('/') }}" class="ath-logo"><img style="width:160px" src="{{ asset('/images/') .'/'. $basic->site_image }}" srcset="{{ asset('/images/') .'/'. $basic->site_image }} 2x" alt="logo"></a>
                        </div>
                            @yield('content')
                    </div>
            </main>
        </div>
	<div class="preloader"><span class="spinner spinner-alt"><img class="spinner-brand" src="{{ asset('/images/') .'/'. $basic->site_image }}" alt=""></span></div>
	
	<!-- JavaScript -->
	<script src="{{ asset('main/assets/js/jquery.bundle.js?ver=192') }}"></script>
	<script src="{{ asset('main/assets/js/scripts.js?ver=192') }}"></script>
	<script src="{{ asset('main/assets/js/charts.js') }}"></script>
</body>
</html>