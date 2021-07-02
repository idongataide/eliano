@extends('layouts.home')
@section('title', 'Contact us')
@section('content')
<section class="page-header">
<div class="page-header__bg" style="background-image: url({{asset('sureloan/assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
<!-- /.page-header__bg -->
<div class="container">
    <ul class="thm-breadcrumb list-unstyled">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>/</li>
        <li><span>Contact Us</span></li>
    </ul><!-- /.thm-breadcrumb list-unstyled -->
    <h2>Contact Us</h2>
</div><!-- /.container -->
</section><!-- /.page-header -->

<section class="contact-one">
            <div class="container">
                <div class="block-title text-center">
                    <p>Contact With Us</p>
                    <h2>Leave a Message</h2>
                </div><!-- /.block-title -->
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-one__content">
                            <p>{!! $basic->contact_page !!}</p>
                            <div class="contact-one__box">
                                <i class="pylon-icon-telephone"></i>
                                <div class="contact-one__box-content">
                                    <h4>Call Anytime</h4>
                                    <a href="#">{{$basic->phone}}</a>
                                </div><!-- /.contact-one__box-content -->
                            </div><!-- /.contact-one__box -->
                            <div class="contact-one__box">
                                <i class="pylon-icon-email1"></i>
                                <div class="contact-one__box-content">
                                    <h4>Write Email</h4>
                                    <a href="#">{{$basic->email}}</a>
                                </div><!-- /.contact-one__box-content -->
                            </div><!-- /.contact-one__box -->
                            <div class="contact-one__box">
                                <i class="pylon-icon-pin1"></i>
                                <div class="contact-one__box-content">
                                    <h4>Visit Office</h4>
                                    <a href="#">{{$basic->address}}</a>
                                </div><!-- /.contact-one__box-content -->
                            </div><!-- /.contact-one__box -->
                        </div><!-- /.contact-one__content -->
                    </div><!-- /.col-lg-5 -->

                    <div class="col-lg-7">


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


                        <form  method="post" class="contact-one__form" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                            <div class="row low-gutters">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Your Name" name="name" required>
                                </div><!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <input type="email" placeholder="Your Email" name="email" required>
                                </div><!-- /.col-md-6 -->
                                <div class="col-md-12">
                                    <textarea name="message" placeholder="Write Message"></textarea>
                                    <button class="thm-btn" type="submit">Send A Message</button>
                                </div><!-- /.col-md-6 -->
                            </div><!-- /.row -->

                        </form><!-- /.contact-one__from -->
                    </div><!-- /.col-lg-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.contact-one -->

@endsection