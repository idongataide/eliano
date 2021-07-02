<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Ime Iteh">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="loan, borrow, lend, repayment">
	<!-- Fav Icon  -->
	<link rel="shortcut icon" href="{{ asset('/images/') .'/'. $basic->favicon }}">
	<!-- Site Title  -->
	<title>@yield('title') | {{$basic->name}}</title>
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/vendor.bundle.css?ver=101') }}">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/style.css?ver=101') }}">
	
</head>

<body class="user-dashboard">    
    <div class="topbar">
        <div class="topbar-md d-lg-none">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="toggle-nav">
                        <div class="toggle-icon">
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                            <span class="toggle-line"></span>
                        </div>
                    </a><!-- .toggle-nav -->

                    <div class="site-logo">
                        <a href="{{url('/')}}" class="site-brand">
                            <img src="{{ asset('/images/') .'/'. $basic->site_image }}" alt="logo" srcset="{{ asset('/images/') .'/'. $basic->site_image }} 2x">
                        </a>
                    </div><!-- .site-logo -->
                    
                    <div class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="{{ asset('/images/users') .'/'. Auth::user()->user_img }}" alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name">{{ Auth::user()->name }} <span>( {{Auth::user()->reg_no}} )</span></h6>
                                    <span class="user-dropdown-email">{{Auth::user()->email}}</span>
                                </div>
                                <div class="user-dropdown-balance">
                                    <h6>LOAN BALANCE</h6>
                                    <h3>120,000,000 IC0X</h3>
                                    <ul>
                                        <li>1.240 BTC</li>
                                        <li>19.043 ETH</li>
                                        <li>6,500.13 USD</li>
                                    </ul>
                                </div>
                                <ul class="user-dropdown-btns btn-grp guttar-10px">
                                        <h6 class="user-dropdown-name">{{Auth::user()->name}} <span>({{Auth::user()->reg_no}})</span></h6>
                                        <span class="user-dropdown-email">{{Auth::user()->email}}</span>
                                </ul>
                                <div class="gaps-1x"></div>
                                <ul class="user-dropdown-links">
                                        <li><a href="{{ route('user.profile') }}"><i class="ti ti-id-badge"></i>Profile</a></li>
                                        <li><a href="{{ route('user.security') }}"><i class="ti ti-lock"></i>Security</a></li>
                                        <li><a href="{{ route('user.activity') }}"><i class="ti ti-eye"></i>Activity</a></li>
                                </ul>
                                <ul class="user-dropdown-links">
                                <li>
                                    <a href="{!! url('/logout') !!}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ti ti-power-off"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .toggle-action -->
                </div><!-- .container -->
            </div><!-- .container -->
        </div><!-- .topbar-md -->
        <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="topbar-lg d-none d-lg-block">
                    <div class="site-logo">
                        <a href="{{ url('/') }}" class="site-brand">
                            <img src="{{ asset('/images/') .'/'. $basic->site_image }}" alt="logo" srcset="{{ asset('/images/') .'/'. $basic->site_image }} 2x">
                        </a>
                    </div><!-- .site-logo -->
                </div><!-- .topbar-lg -->

                <div class="topbar-action d-none d-lg-block">
                    <ul class="topbar-action-list">
                        <li class="topbar-action-item topbar-action-link">
                            <a href="{{ url('/') }}"><em class="ti ti-home"></em> Home</a>
                        </li><!-- .topbar-action-item -->

                         <li class="dropdown topbar-action-item topbar-action-user">
                            <a href="#" data-toggle="dropdown"> <img class="icon" src="{{ asset('/images/users') .'/'. Auth::user()->user_img }}" alt="thumb"> </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown">
                                    <div class="user-dropdown-head">
                                        <h6 class="user-dropdown-name">{{Auth::user()->name}} <span>({{Auth::user()->reg_no}})</span></h6>
                                        <span class="user-dropdown-email">{{Auth::user()->email}}</span>

                                    </div>
                                    
                                    <div class="gaps-1x"></div>
                                    <ul class="user-dropdown-links">
                                        <li><a href="{{ route('user.profile') }}"><i class="ti ti-id-badge"></i>Profile</a></li>
                                        <li><a href="{{ route('user.security') }}"><i class="ti ti-lock"></i>Security</a></li>
                                        <li><a href="{{ route('user.activity') }}"><i class="ti ti-eye"></i>Activity</a></li>
                                    </ul>
                                    <ul class="user-dropdown-links">
                                        <li>
                                            <a href="{!! url('/logout') !!}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="ti ti-power-off"></i>Logout
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li><!-- .topbar-action-item -->
                    </ul><!-- .topbar-action-list -->
                </div><!-- .topbar-action -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- TopBar End -->
    
    
    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">
                <div class="user-sidebar">
                    <div class="user-sidebar-overlay"></div>
                    <div class="user-box d-none d-lg-block">
                        <div class="user-image">
                            <img src="{{ asset('/images/users') .'/'. Auth::user()->user_img }}" alt="thumb">
                        </div>
                        <h6 class="user-name">{{Auth::user()->name}}</h6>
                        <div class="user-uid">Username: <span>{{Auth::user()->username}}</span></div>
                        
                        {{--
                        <ul class="btn-grp guttar-10px">
                            <li><a href="#" class="btn btn-xs btn-warning">{{$basic->currency_sym.number_format(Auth::user()->amount,2)}}</a></li>
                            <li><a href="#" class="btn btn-xs btn-warning">{{round(Auth::user()->point)}} Point</a></li>
                        </ul>
                        --}}
                    </div><!-- .user-box -->
                    <ul class="user-icon-nav">

                        <li><a href="{{ route('user.home') }}"><em class="ti ti-dashboard"></em>Dashboard</a></li>

                        @if(Auth::user()->roleid == 4)
                        <li><a href="{{ route('user.loan.index') }}"><em class="ti ti-files"></em>Loans</a></li>
                        <li><a href="{{ route('managepayment.index') }}"><em class="ti ti-control-shuffle"></em>Repayments</a></li>
                        @endif

                        @if(Auth::user()->roleid == 5)
                        <li><a href="{{ route('user.refferal') }}"><em class="ti ti-infinite"></em>Contributors</a></li>
                        @endif
                                               
                        <li>
                        <a href="{!! url('/logout') !!}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-power-off"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    <div class="user-sidebar-sap"></div><!-- .user-sidebar-sap -->
                    <ul class="user-nav">
                        <li><a href="{{ url('contactus') }}">Contact Us</a></li>
                        <li><a href="{{ url('faqs') }}">Faqs</a></li>
                        <li>Contact Support<span>{{$basic->email}}</span></li>
                    </ul><!-- .user-nav -->
                    <div class="d-lg-none">
                        <div class="user-sidebar-sap"></div>
                        <div class="gaps-1x"></div>
                        <ul class="topbar-action-list">
                            <li class="topbar-action-item topbar-action-link">
                                <a href="{{ url('/') }}"><em class="ti ti-home"></em>Home</a>
                            </li><!-- .topbar-action-item -->
                        </ul><!-- .topbar-action-list -->
                    </div>
                </div><!-- .user-sidebar -->

                @yield('content')
    
    <div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <span class="footer-copyright">Copyright {{date('Y')}}, <a href="{{url('/')}}">{{$basic->name}}</a>.  All Rights Reserved.</span>
                </div><!-- .col -->
                <div class="col-md-5 text-md-right">
                    
                    <ul class="footer-links">
                        <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('terms-and-conditions')}}">Terms of Loan</a></li>
                    </ul>

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
    <!-- FooterBar End -->
    
    
	<!-- JavaScript (include all script here) -->
	<script src="{{ asset('front/assets/js/jquery.bundle.js?ver=101') }}"></script>
	<script src="{{ asset('front/assets/js/script.js?ver=101') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
