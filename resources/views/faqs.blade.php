@extends('layouts.home')
@section('title', 'faq')
@section('content')
<section class="page-header">
<div class="page-header__bg" style="background-image: url({{asset('sureloan/assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
<!-- /.page-header__bg -->
<div class="container">
    <ul class="thm-breadcrumb list-unstyled">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>/</li>
        <li><span>FAQs</span></li>
    </ul><!-- /.thm-breadcrumb list-unstyled -->
    <h2>Frequently Asked Questions</h2>
</div><!-- /.container -->
</section><!-- /.page-header -->


<section class="faq-one faq-one__faq-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <ul id="accordion" class="mb-0 wow fadeInUp list-unstyled" data-wow-duration="1500ms">

                        @foreach($faq as $data)
                            <li>
                                <h2 class="para-title">
                                    <span class="collapsed" role="button" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="far fa-plus"></i>
                                        {{$data->name}} 
                                    </span>
                                </h2>
                                <div id="collapse{{$data->id}}" class="collapse" role="button" aria-labelledby="collapse{{$data->id}}" data-parent="#accordion">
                                    <p>{!! $data->description !!}</p>
                                </div>
                            </li>
                        @endforeach

 
                        </ul>
                    </div><!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="faq-one__box">
                            <img src="{{ asset('sureloan/assets/images/resources/faq-box-1-1.png') }}" class="img-fluid" alt="">
                            <div class="main-header__info">
                                <div class="main-header__info-phone">
                                    <i class="pylon-icon-tech-support"></i>
                                    <div class="main-header__info-phone-content">
                                        <span>Call Anytime</span>
                                        <h3><a href="tel:{{$basic->phone}}">{{$basic->phone}}</a></h3>
                                    </div><!-- /.main-header__info-phone-content -->
                                </div><!-- /.main-header__info-phone -->
                            </div><!-- /.main-header__info -->
                        </div><!-- /.faq-one__box -->
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.faq-one -->





        
@endsection