<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ $basic->name }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{ asset('/images/') .'/'. $basic->favicon }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">

    
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
          
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">


    <!-- iCheck -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">


<!--
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/animate.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/custom.css')}}"/>-->

    <link href="{{ asset('amcharts/plugins/export/export.css') }}"  rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('backend/css/datapicker/datepicker3.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('backend/css/daterangepicker/daterangepicker-bs3.css')}}"/>

    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('backend/css/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('backend/css/toastr/toastr.min.css')}}"/>

    <link href="{{asset('/css2/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <!--
    <link href="{{asset('/css2/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    -->
    <link rel="stylesheet" type="text/css" id="theme1" href="{{asset('css/required.css')}}"/> 
    <link rel="stylesheet" type="text/css" id="theme2" href="{{asset('css/app.css')}}"/> 
    <link rel="stylesheet" type="text/css" id="theme3" href="{{asset('css/design-sheet.css')}}"/> 
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link href="promise/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}"/> 
    
    @yield('css')
    <style>
    .skin-blue .main-header .navbar, .skin-blue .main-header .logo  {
       background-color:#c7ad00 !important;
    }
    .box.box-primary {
    border-top-color: #333  !important;
}
    </style>
</head>
<!-- sidebar-collapse -->
<body class="skin-blue  sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{url('/')}}" class="logo">
              <span class="logo-mini"><b>Eliana Elio</b></span>
              <span class="logo-lg">Elianaelio Coperative</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    
                <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('/images/') .'/'. $basic->site_image }}"
                                     class="user-image" alt="Site Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('/images/') .'/'. $basic->site_image }}"
                                         class="img-circle" alt="Site Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('adminusers.edit',[Auth::user()->id]) }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © {{date('Y')}} <a href="#">{{ $basic->name }}</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                   {{$basic->name_prefix}}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
   
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script type="text/javascript" src="/js/clock.js"></script>
    <audio id="audio-alert" src="{{asset('backend/audio/alert.mp3')}}" preload="auto"></audio>
<audio id="audio-fail" src="{{asset('backend/audio/fail.mp3')}}" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS 
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap/bootstrap.min.js')}}"></script>-->
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src="{{asset('backend/js/plugins/icheck/icheck.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('backend/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>



<script type="text/javascript" src="{{asset('backend/js/plugins/morris/raphael-min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/morris/morris.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/rickshaw/d3.v3.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/rickshaw/rickshaw.min.js')}}"></script>
<script type='text/javascript' src="{{asset('backend/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type='text/javascript' src="{{asset('backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type='text/javascript' src="{{asset('backend/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/owl/owl.carousel.min.js')}}"></script>

<script type="text/javascript" src="{{asset('backend/js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE 
<script type="text/javascript" src="{{asset('backend/js/settings.js')}}"></script>
-->
<script type="text/javascript" src="{{asset('backend/js/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/actions.js')}}"></script>

<script type="text/javascript" src="{{asset('backend/js/demo_dashboard.js')}}"></script>


<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src="{{asset('backend/js/plugins/icheck/icheck.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('backend/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

<script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>


<script type="text/javascript" src="{{asset('backend/js/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{asset('js2/select2.min.js')}}" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<!--
<script src="{{asset('/js2/plugins/dataTables/jquery.dataTables.js')}}" type="text/javascript"></script>


<script src="{{asset('/js2/plugins/dataTables/dataTables.bootstrap.js')}}" type="text/javascript"></script>

-->
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
    @stack('scripts')

    <script src="{{asset('/')}}js/script.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $("#example2").DataTable();
            $('#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });

        
    </script>

</body>
</html>