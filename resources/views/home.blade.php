@extends('layouts.home')
@section('title', 'Home')
@section('content')
        <section class="main-slider">
            <div class="swiper-container thm-swiper__slider" data-swiper-options='{}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="image-layer" style="background-image: url({{asset('sureloan/assets/images/main-slider/bg1.jpg')}});"></div>
                        <!-- /.image-layer -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <p>Simple & Secure Payment Process</p>
                                    <h2>Let’s fund your side hustle</h2>
                                    <a href="{{url('register')}}" class=" thm-btn">Apply For Loan</a>
                                    <!-- /.thm-btn dynamic-radius -->
                                </div><!-- /.col-lg-7 text-right -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div><!-- /.swiper-slide -->
                                 
                </div><!-- /.swiper-wrapper -->
            

            </div><!-- /.swiper-container thm-swiper__slider -->
            <div class="feature-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 wow fadeInUp" data-wow-duration="1500ms">
                            <div class="feature-two__box">
                                <i class="pylon-icon-consumer-behavior"></i>
                                <p>Low Interest</p>
                            </div><!-- /.feature-two__box -->
                        </div><!-- /.col-lg-4 col-md-6 -->
                        <div class="col-lg-2 col-md-2 wow fadeInUp" data-wow-duration="1500ms">
                            <div class="feature-two__box">
                                <i class="pylon-icon-consumer-behavior"></i>
                                <p>Low Interest</p>
                            </div><!-- /.feature-two__box -->
                        </div><!-- /.col-lg-4 col-md-6 -->
                        <div class="col-lg-2 col-md-2 wow fadeInUp" data-wow-duration="1500ms">
                            <div class="feature-two__box">
                                <i class="pylon-icon-point-of-sale"></i>
                                <p>Fixed Term</p>
                            </div><!-- /.feature-two__box -->
                        </div><!-- /.col-lg-4 col-md-6 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.feature-two -->
        </section><!-- /.main-slider -->

        <section class="about-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-one__content">
                            <div class="block-title text-left">
                                <p>{{$product->name}},</p>
                                <h2>{{$product->sub_title}}</h2>
                            </div><!-- /.block-title -->
                            <p>{{$product->description}}
                            </p><!-- /.about-one__text -->
                        </div><!-- /.about-one__content -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <form action="{{url('login')}}" id="loan-calculator" data-interest-rate="{{$product->interest_rate}}" class="about-one__form wow fadeInRight" data-wow-duration="1500ms">
                            <h3>How Much You Need</h3>
                            <div class="about-one__form-content">
                                <div class="input-box__top">
                                    <span>{{$basic->currency_sym}}{{number_format($product->minimum_principal,2)}}</span>
                                    <span>{{$basic->currency_sym}}{{number_format($product->maximum_principal,2)}}</span>
                                    <input type="hidden" value="{{$product->minimum_principal}}" id="minimum_principal">
                                    <input type="hidden" value="{{$product->maximum_principal}}" id="maximum_principal">
                                </div><!-- /.input-box__top -->
                                <br>
                                <div class="input-box">
                                    <div class="range-slider-count" id="range-slider-count"></div>
                                    <input type="hidden" value="" id="min-value-rangeslider-count">
                                    <input type="hidden" value="" id="max-value-rangeslider-count">
                                    <input type="hidden" value="{{$product->interest_period}}" id="interest_period">
                                    <input type="hidden" value="{{$product->interest_method}}" id="interest_method">
                                    <input type="hidden" value="{{$product->repayment_cycle}}" id="repayment_cycle">

                                </div><!-- /.input-box -->
                                <div class="input-box__top">
                                    <span>1 {{App\Models\loan_period_type::where('code',$product->interest_period)->select('name')->pluck('name')->first()}}</span>
                                    <span>12 {{App\Models\loan_period_type::where('code',$product->interest_period)->select('name')->pluck('name')->first()}}s</span>
                                </div><!-- /.input-box__top -->
                                <div class="input-box">
                                    <div class="range-slider-month" id="range-slider-month"></div>
                                    <input type="hidden" value="" id="min-value-rangeslider-month">
                                    <input type="hidden" value="" id="max-value-rangeslider-month">
                                </div><!-- /.input-box -->
                                <p>
                                    <span>Pay {{App\Models\loan_repayment_type::where('code',$product->repayment_cycle)->select('name')->pluck('name')->first()}}</span>
                                    <b>{{$basic->currency_sym}}<i id="loan-monthly-pay"></i></b>
                                </p>
                                <p>
                                    <span>Term of Use</span>
                                    <b><i id="loan-month"></i> {{App\Models\loan_repayment_type::where('code',$product->repayment_cycle)->select('description')->pluck('description')->first()}}s</b>
                                </p>
                                <p>
                                    <span>Interest Rate</span>
                                    <b><i id="loan-interest-rate">{{$product->interest_rate}}%</i></b>
                                </p>
                                <p>
                                    <span>Total Pay Back</span>
                                    <b>{{$basic->currency_sym}}<i id="loan-total"></i></b>
                                </p>
                                <button type="submit" class="thm-btn">Apply For Loan</button>
                            </div><!-- /.about-one__from-content -->
                        </form><!-- /.about-one__form -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.about-one -->

        <section class="service-one">
            <div class="container">
                <div class="block-title text-center">
                    <p>What We’re Offering</p>
                    <h2>All Loans Services</h2>
                </div><!-- /.block-title -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service-one__card">
                            <div class="service-one__image">
                                <img src="{{asset('sureloan/assets/images/services/services-1-1.jpg')}}" alt="sureloan">
                            </div><!-- /.service-one__image -->
                            <div class="service-one__content">
                                <h3><a href="#">Get a Low Rate</a></h3>
                                <p style="text-align:justify; font-size:15px">Get a loan with a fixed rate that does not go up. Check your rate instantly online
                                </p>
                                <a href="#" class="pylon-icon-right-arrow service-one__link"></a><!-- /.service-one__link -->
                            </div><!-- /.service-one__content -->
                        </div><!-- /.service-one__card -->
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <div class="service-one__card">
                            <div class="service-one__image">
                                <img src="{{asset('sureloan/assets/images/services/services-1-2.jpg')}}" alt="">
                            </div><!-- /.service-one__image -->
                            <div class="service-one__content">
                                <h3><a href="#">Pay as you choose</a></h3>
                                <p>Choose a loan repayment tenor that works for you</p>
                                <a href="#" class="pylon-icon-right-arrow service-one__link"></a><!-- /.service-one__link -->
                            </div><!-- /.service-one__content -->
                        </div><!-- /.service-one__card -->
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <div class="service-one__card">
                            <div class="service-one__image">
                                <img src="{{asset('sureloan/assets/images/services/services-1-3.png')}}" alt="">
                            </div><!-- /.service-one__image -->
                            <div class="service-one__content">
                                <h3><a href="#">Save money</a></h3>
                                <p>Save money with no pre- payment penalties</p>
                                <a href="#" class="pylon-icon-right-arrow service-one__link"></a><!-- /.service-one__link -->
                            </div><!-- /.service-one__content -->
                        </div><!-- /.service-one__card -->
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.service-one -->

       
        <section id="howitworks" class="feature-three">
            <div class="container">
                    <div class="block-title text-center">
                            <h3>How It Works</h3>
                        </div><!-- /.block-title -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-three__box">
                            <div class="feature-three__box-inner">
                                <i class="pylon-icon-consumer-behavior"></i>
                                <h3><a href="#">Create an account
                                </a></h3>
                                <p>Register through our website or by chatting with us on WhatsApp
                                </p>
                            </div><!-- /.feature-three__box-inner -->
                        </div><!-- /.feature-three__box -->
                    </div><!-- /.col-lg-3 col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-three__box">
                            <div class="feature-three__box-inner">
                                <i class="pylon-icon-point-of-sale"></i>
                                <h3><a href="#">Apply for Loan</a></h3>
                                <p>Choose your loan amount, answer a few questions and get your rate instantly
                                </p>
                            </div><!-- /.feature-three__box-inner -->
                        </div><!-- /.feature-three__box -->
                    </div><!-- /.col-lg-3 col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-three__box">
                            <div class="feature-three__box-inner">
                                <i class="pylon-icon-investment"></i>
                                <h3><a href="#">Select your Loan</a></h3>
                                <p>Select the offer that works best for you and our loan officers get right to work
                                </p>
                            </div><!-- /.feature-three__box-inner -->
                        </div><!-- /.feature-three__box -->
                    </div><!-- /.col-lg-3 col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-three__box">
                            <div class="feature-three__box-inner">
                                <i class="pylon-icon-assets"></i>
                                <h3><a href="#">Receive Funds
                                </a></h3>
                                <p>In less than 24hrs, you receive a decision, if successful, your money is sent to your account
                                </p>
                            </div><!-- /.feature-three__box-inner -->
                        </div><!-- /.feature-three__box -->
                    </div><!-- /.col-lg-3 col-md-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.feature-three -->
             

        <section class="call-to-action" style="background-image: url({{asset('assets/images/backgrounds/call-to-action-bg-1-1.jpg')}});">
            <div class="container">
                <div class="left-content">
                    <p><span>Simple</span><span>Transparent</span><span>Secure</span></p>
                    <h3>Get a Business Loans Quickly</h3>
                </div><!-- /.left-content -->
                <div class="right-content">
                    <a href="{{url('register')}}" class="thm-btn">Apply For Loan</a><!-- /.thm-btn -->
                </div><!-- /.right-content -->
            </div><!-- /.container -->
        </section><!-- /.call-to-action -->
        
        <div id="quickguide" class="we-trusted-area trusted-padding pt-5">
            <div class="container">
            <div class="row d-flex align-items-end">
            <div class="col-xl-8 col-lg-8">
            <div class="trusted-img wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
            <img src="{{asset('sureloan/assets/images/backgrounds/faq.jpg')}}" alt="">
            </div>
            </div>
            <div class="col-xl-4 col-lg-4">
            <div class="trusted-caption">
            <h2> Got a Question? </h2>
            <p>Browse through some of our frequently asked questions </p>
            <a href="{{url('faqs')}}" class="thm-btn">FAQ</a>
            </div>
            </div>
            </div>
            </div>
            </div>
            <section class="feature-one">
                    <img src="{{asset('sureloan/assets/images/shapes/feature-shape-1-1.png')}}" alt="" class="feature-one__shape-1">
                    <img src="{{asset('sureloan/assets/images/shapes/feature-shape-1-2.png')}}" alt="" class="feature-one__shape-2">
                    <img src="{{asset('sureloan/assets/images/shapes/feature-shape-1-3.png')}}" alt="" class="feature-one__shape-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="block-title text-left">
                                    <p>Get to Know About</p>
                                    <h2>Flexible and Quick Business Loans</h2>
                                </div><!-- /.block-title -->
                            </div><!-- /.col-lg-6 -->
                          
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="feature-one__box">
                                    <i class="pylon-icon-assets"></i>
                                    <p>Very Low Rates on
                                        All Loans</p>
                                </div><!-- /.feature-one__box -->
                            </div><!-- /.col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="feature-one__box">
                                    <i class="pylon-icon-verification"></i>
                                    <p>99.9% Success Rate
                                        Guarantee</p>
                                </div><!-- /.feature-one__box -->
                            </div><!-- /.col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="feature-one__box">
                                    <i class="pylon-icon-finance"></i>
                                    <p>Flexible with Your
                                        Repayments</p>
                                </div><!-- /.feature-one__box -->
                            </div><!-- /.col-lg-4 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </section><!-- /.feature-one -->
                <section class="">                   
                        <div class="container">
                        <div class="block-title text-center mt-5 mb-0">
                            <h3>Apply through any of our channels</h3>
                        </div><!-- /.block-title -->       
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="feature-one__boxs">
                                    <i class="fa fa-laptop"></i>
                                    <h3 class="mt-2" style="margin-bottom:-10px">Online</h3>
                                    <small>Log into our web platform to apply and track your repayments                             </small>
                                    <a href="{{url('register')}}" class="thm-btn">Apply Now</a>
                                </div><!-- /.feature-one__box -->
                            </div><!-- /.col-lg-4 -->
                           
                            <div class="col-lg-6">
                                    <div class="feature-one__boxs">
                                        <img src="{{asset('sureloan/assets/images/whatsapp.png')}}" width="60px">
                                        <h3 class="mt-2" style="margin-bottom:-10px">Whatsapp</h3>
                                        <small>Apply for your loan from anywhere. Simply chat with us on WhatsApp                             </small>
                                        <a href="#faq" class="scrollto thm-btn">Chat with Us</a>
                                        <a href="#" class="thm-btn"><span class="fa fa-play-circle"></span> Watch the Video</a> 
                                    </div><!-- /.feature-one__box -->
                                </div><!-- /.col-lg-4 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </section><!-- /.feature-one -->
                @endsection