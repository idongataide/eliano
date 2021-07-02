@extends('layouts.front')
@section('title', 'NOT FOUND')
@section('content')
<div class="nk-wrap ov-h">
        <div class="container">
            <main class="nk-pages nk-pages-centered tc-light px-0 text-center">
                <header class="pt-5">
                    <a href="{{url('/')}}" class="d-inline-block logo-lg"><img src="{{ asset('/images/') .'/'. $basic->site_image }}" srcset="{{ asset('/images/') .'/'. $basic->site_image }}" alt="logo"></a>
                </header>
                <div class="my-auto py-5">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-md-7 col-sm-9">
                            <div class="position-relative">
                                <h2 class="title-xxl-grad">404</h2>
                                <h5 class="pb-2">Opps! Why you’re here?</h5>
                                <p class="">We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.</p>
                                <a href="{{url('/')}}" class="btn btn-grad btn-md btn-round">Back to home</a>
                            </div> 
                        </div>
                    </div>
                </div>
                <footer class="pb-5 tc-light">
                    <ul class="social mb-3">
                    <li><a href="{{$basic->facebook}}"><em class="fab fa-facebook-f"></em></a></li>
                    <li><a href="{{$basic->twitter}}"><em class="fab fa-twitter"></em></a></li>
                    <li><a href="{{$basic->youtube}}"><em class="fab fa-youtube"></em></a></li>
                    <li><a href="{{$basic->instagram}}"><em class="fab fa-instagram"></em></a></li>
                    </ul>
                    <p class="copyright-text copyright-text-s3"><p>© Copyright 2021, {{$basic->name}}. All Rights Reserved.</p></p>
                </footer>
            </main>
        </div>
        <div class="nk-ovm shape-z4"></div>
@endsection