<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{$basic->name}}</title>
    <!-- favicons Icons -->
    <link rel="shortcut icon" href="{{ asset('/images/') .'/'. $basic->favicon }}">
    <link rel="manifest" href="sureloan/assets/images/favicons/site.webmanifest">
    <meta name="description" content="sureloan website">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/pylon-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/nouislider.pips.css') }}">

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('sureloan/assets/css/main.css') }}">
</head>

<body>
    <div class="preloader">
        <img class="preloader__image" src="{{ asset('/images/') .'/'. $basic->site_image }}" alt="sureloan">
    </div><!-- /.preloader -->
    <div class="page-wrapper">
        <header id="header"  class="main-header">
            <div class="topbar">
                <div class="container">
                    <div class="topbar__left">
                        <div class="topbar__social">
                            <a href="{{$basic->facebook}}" class="fab fa-facebook-square"></a>
                            <a href="{{$basic->twitter}}" class="fab fa-twitter"></a>
                            <a href="{{$basic->instagram}}" class="fab fa-instagram"></a>
                        </div><!-- /.topbar__social -->
                        <a href="{{url('login')}}">Login</a>
                        <a href="{{url('faqs')}}">FAQs</a>
                    </div><!-- /.topbar__left -->
                    <div class="topbar__right">
                        <a href="#"><i class="pylon-icon-email1"></i>{{$basic->email}}</a>
                        <a href="#"><i class="pylon-icon-clock2"></i>24/7 Availabale</a>
                    </div><!-- /.topbar__right -->
                </div><!-- /.container -->
            </div><!-- /.topbar -->
            <nav  class="main-menu">
                <div class="container">
                    <div class="logo-box">
                        <a href="{{url('/')}}" aria-label="logo image"><img src="{{ asset('/images/') .'/'. $basic->site_image }}" width="155" alt="sureloan"></a>
                        <span class="fa fa-bars mobile-nav__toggler"></span>
                    </div><!-- /.logo-box -->
                    <ul class="main-menu__list">
                        <li class="dropdown">
                            <a href="{{url('/')}}">Home</a>                          
                        </li>                      
                        
                        <li ><a href="#howitworks"> How It Works</a></li>
                        <li><a href="#quickguide">Quick Guides</a></li>
                        <li><a href="{{url('contact-us')}}">Contact</a></li>                   
                    </ul>
                    <!-- /.main-menu__list -->

                    <div class="main-header__info">
                        <div class="main-header__info-phone">
                            <i class="pylon-icon-tech-support"></i>
                            <div class="main-header__info-phone-content">
                                <span>Call Anytime</span>
                                <h3><a href="tel:{{$basic->phone}}">{{$basic->phone}}</a></h3>
                            </div><!-- /.main-header__info-phone-content -->
                        </div><!-- /.main-header__info-phone -->
                    </div><!-- /.main-header__info -->
                </div><!-- /.container -->
            </nav>
            <!-- /.main-menu -->
        </header><!-- /.main-header -->

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->


        @yield('content')


        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget footer-widget__about">
                            <a href="{{url('/')}}">
                                <img src="{{asset('sureloan/assets/images/logo-light.png')}}" width="155" alt="">
                            </a>
                            <p>Lorem ipsum is not dolor sit amet, consect etur adi pisicing elit sed eiusmod tempor ut labore.</p>
                            <div class="footer-widget__about-phone">
                                <i class="pylon-icon-tech-support"></i>
                                <div class="footer-widget__about-phone-content">
                                    <span>Call Anytime</span>
                                    <h3><a href="#">{{$basic->email}}</a></h3>
                                </div><!-- /.footer-widget__about-phone-content -->
                            </div><!-- /.footer-widget__about-phone -->
                        </div><!-- /.footer-widget footer-widget__about -->
                    </div><!-- /.col-lg-3 -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget footer-widget__link">
                            <h3 class="footer-widget__title">Explore</h3>
                            <ul class="list-unstyled footer-widget__link-list">
                                <li><a href="{{url('about-us')}}">About</a></li>
                                <li><a href="{{url('contact-us')}}">Contact us</a></li>
                                <li><a href="{{url('faqs')}}">FAQs</a></li>
                                <li><a href="{{url('testimonials')}}">Testimonials</a></li>
                            </ul><!-- /.list-unstyled -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-lg-2 -->
                    <div class="col-lg-2 col-md-6">
                            <div class="footer-widget footer-widget__link">
                                <h3 class="footer-widget__title">Actions</h3>
                                <ul class="list-unstyled footer-widget__link-list">
                                    <li><a href="{{url('register')}}">Get Loan</a></li>
                                    <li><a href="{{url('login')}}">Make Repayment</a></li>
                                    <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                                    <li><a href="{{url('terms-and-conditions')}}">T&Cs</a></li>
                                </ul><!-- /.list-unstyled -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-widget__contact">
                            <h3>Contact</h3>
                            <ul class="list-unstyled footer-widget__contact-list">
                                <li>
                                    <a href="#"><i class="pylon-icon-email1"></i>{{$basic->email}}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="pylon-icon-clock2"></i>Mon - Sat 8:00 AM - 6:00 PM</a>
                                </li>
                                <li>
                                    <a href="#"><i class="pylon-icon-pin1"></i>{{$basic->address}}</a>
                                </li>
                            </ul>
                        </div><!-- /.footer-widget footer-widget__contact -->
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </footer><!-- /.site-footer -->
        <div class="bottom-footer">
            <div class="container">
                <p>© Copyright {{date('Y')}} by {{$basic->name}}</p>
                <div class="bottom-footer__social">
                    <a href="{{$basic->facebook}}" class="fab fa-facebook-square"></a>
                    <a href="{{$basic->twitter}}" class="fab fa-twitter"></a>
                    <a href="{{$basic->instagram}}" class="fab fa-instagram"></a>
                </div><!-- /.bottom-footer__social -->
            </div><!-- /.container -->
        </div><!-- /.bottom-footer -->

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="far fa-times"></i></span>

            <div class="logo-box">
                <a href="{{url('/')}}" aria-label="logo image"><img src="{{ asset('/images/') .'/'. $basic->site_image }}" width="155" alt="sureloan" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="pylon-icon-email1"></i>
                    <a href="mailto:{{$basic->email}}">{{$basic->email}}</a>
                </li>
                <li>
                    <i class="pylon-icon-telephone"></i>
                    <a href="tel:{{$basic->phone}}">{{$basic->phone}}</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="{{$basic->twitter}}" aria-label="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{$basic->facebook}}" aria-label="facebook"><i class="fab fa-facebook-square"></i></a>
                    <a href="{{$basic->instagram}}" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>


    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="{{asset('sureloan/assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/wow.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/wNumb.min.js')}}"></script>
    <script src="{{asset('sureloan/assets/js/nouislider.min.js')}}"></script>

    <!-- template js -->
    <script src="{{asset('sureloan/assets/js/theme.js')}}"></script>
</body>

</html>