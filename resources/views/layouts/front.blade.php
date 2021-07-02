<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
<meta charset="utf-8">
<meta name="author" content="Ime Iteh">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<!-- Fav Icon  -->
<link rel="shortcut icon" href="{{ asset('/images/') .'/'. $basic->favicon }}">
<!-- Site Title  -->
<title>@yield('title') | {{$basic->name}}</title>
<!-- Bundle and Base CSS -->
<link rel="stylesheet" href="{{ asset('main/assets/css/vendor.bundle.css?ver=192') }}">
<link rel="stylesheet" href="{{ asset('main/assets/css/style-lobelia.css?ver=192') }}" id="changeTheme">

<link rel="stylesheet" type="text/css" id="theme1" href="{{asset('css/required.css')}}"/> 
<!-- Extra CSS -->
<link rel="stylesheet" href="{{ asset('main/assets/css/theme.css?ver=192') }}">
</head>
    <body class="nk-body body-wider mode-onepage bg-light">
	<div class="nk-wrap">
		<header class="nk-header page-header is-transparent is-sticky is-shrink" id="header">
		    <!-- Header @s -->
			<div class="header-main">
				<div class="header-container container">
					<div class="header-wrap">
						<!-- Logo @s -->
						<div class="header-logo logo animated" data-animate="fadeInDown" data-delay=".6">
							<a href="./" class="logo-link">
								<img class="logo-dark" src="{{ asset('/images/') .'/'. $basic->site_image }}" srcset="{{ asset('/images/') .'/'. $basic->site_image }} " alt="logo">
								<img class="logo-light" src="{{ asset('/images/') .'/'. $basic->site_image }}" srcset="{{ asset('/images/') .'/'. $basic->site_image }}" alt="logo">
							</a>
						</div>

						<!-- Menu Toogle @s -->
						<div class="header-nav-toggle">
							<a href="#" class="navbar-toggle" data-menu-toggle="header-menu">
                                <div class="toggle-line">
                                    <span></span>
                                </div>
                            </a>
						</div>

						<!-- Menu @s -->
						<div class="header-navbar animated" data-animate="fadeInDown" data-delay=".75">
							@include('layouts.nav')
						</div><!-- .header-navbar @e -->
					</div>                                                
				</div>
			</div><!-- .header-main @e -->

            <!-- Banner @s -->
            
            @yield('content')
			
    
		<footer class="nk-footer bg-theme-grad">       
			<section class="section section-footer tc-light bg-transparent">
			
				<div class="container">
				    <!-- Block @s -->
					<div class="nk-block block-footer">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 mb-4 mb-sm-0">
                                <div class="wgs wgs-menu">
                                    <h6 class="wgs-title">Company</h6>
                                    <div class="wgs-body">
                                        <ul class="wgs-links">
                                            <li><a href="{{url('about-us')}}">About Us</a></li>
                                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-2 col-sm-4 mb-4 mb-sm-0">
                                <div class="wgs wgs-menu">
                                    <h6 class="wgs-title">Legal</h6>
                                    <div class="wgs-body">
                                        <ul class="wgs-links">
                                            <li><a href="#">Terms &amp; Conditions</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Terms of Sales</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-2 col-sm-4 mb-4 mb-sm-0">
                                <div class="wgs wgs-menu">
                                    <h6 class="wgs-title">Quick Links</h6>
                                    <div class="wgs-body">
                                        <ul class="wgs-links">
                                            <li><a href="{{url('faqs')}}">Faqs</a></li>
                                            <li><a href="{{url('login')}}">Login</a></li>
                                            <li><a href="{{url('register')}}">Signup</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-6 mb-4 mb-lg-0 order-lg-first">
                                <div class="wgs wgs-text">
                                    <div class="wgs-body">
                                        <a href="./" class="wgs-logo">
                                            <img src="{{ asset('/images/') .'/'. $basic->site_image }}" srcset="{{ asset('/images/') .'/'. $basic->site_image }}" alt="logo">
                                        </a>
                                        <p>© Copyright {{date('Y')}}, {{$basic->name}} All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
					</div><!-- .nk-block @e -->
				</div>
				
			</section>
			<div class="nk-ovm shape-b"></div>
		</footer>
	</div>
	
	<div class="preloader preloader-alt no-split"><span class="spinner spinner-alt"><img class="spinner-brand" src="{{ asset('/images/') .'/'. $basic->site_image }}" alt=""></span></div>
	
	<!-- JavaScript -->
	<script src="{{ asset('main/assets/js/jquery.bundle.js?ver=192') }}"></script>
	<script src="{{ asset('main/assets/js/scripts.js?ver=192') }}"></script>
	<script src="{{ asset('main/assets/js/charts.js') }}"></script>
</body>
</html>
