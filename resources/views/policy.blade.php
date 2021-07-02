@extends('layouts.home')
@section('title', 'Privacy & Policy')
@section('content')
<section class="page-header">
<div class="page-header__bg" style="background-image: url({{asset('sureloan/assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
<!-- /.page-header__bg -->
<div class="container">
    <ul class="thm-breadcrumb list-unstyled">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>/</li>
        <li><span>Privacy & Policy</span></li>
    </ul><!-- /.thm-breadcrumb list-unstyled -->
    <h2>Privacy & Policy</h2>
</div><!-- /.container -->
</section><!-- /.page-header -->

<section class="about-three">
    <div class="container">               
        <div class="row">
            <div class="col-lg-6">
                <div class="block-title text-left">
                    <p>Get To Know About Us</p>
                    <h2>{!! $basic->about_page !!}</h2>
                </div><!-- /.block-title -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <p class="block-text">
                {!! $basic->aboutus !!}
                </p><!-- /.block-text -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.about-three -->

@endsection