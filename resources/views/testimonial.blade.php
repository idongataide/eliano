@extends('layouts.home')
@section('title', 'Testimonials')
@section('content')
<section class="page-header">
<div class="page-header__bg" style="background-image: url({{asset('sureloan/assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
<!-- /.page-header__bg -->
<div class="container">
    <ul class="thm-breadcrumb list-unstyled">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>/</li>
        <li><span>Testimonials</span></li>
    </ul><!-- /.thm-breadcrumb list-unstyled -->
    <h2>Testimonials</h2>
</div><!-- /.container -->
</section><!-- /.page-header -->


<section class="testimonials-one testimonials-one__about-page">
                <div class="container">
                    <div class="block-title text-center">
                        <p>Customers Testimonials</p>
                        <h2>Customers Testimonials</h2>
                    </div><!-- /.block-title -->
                    <div class="thm-swiper__slider swiper-container" data-swiper-options='{
            "spaceBetween": 0,
            "slidesPerView": 1,
            "slidesPerGroup": 1,
            "autoplay": {
                "delay": 5000
            },
            "pagination": {
                "el": ".testimonials-one__swiper-pagination",
                "type": "bullets",
                "clickable": true
            },
            "breakpoints": {
                "0": {
                    "spaceBetween": 0,
                    "slidesPerView": 1,
                    "slidesPerGroup": 1
                },
                "375": {
                    "spaceBetween": 0,
                    "slidesPerView": 1,
                    "slidesPerGroup": 1
                },
                "667": {
                    "spaceBetween": 30,
                    "slidesPerView": 2,
                    "slidesPerGroup": 2
                },
                "767": {
                    "spaceBetween": 30,
                    "slidesPerView": 2,
                    "slidesPerGroup": 2
                },
                "991": {
                    "spaceBetween": 30,
                    "slidesPerView": 2,
                    "slidesPerGroup": 2
                },
                "1199": {
                    "spaceBetween": 30,
                    "slidesPerView": 3,
                    "slidesPerGroup": 3
                }
            }}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-1.png" alt="">
                                        <h3>Clyde Williamson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-2.png" alt="">
                                        <h3>Vernon Ray</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-3.png" alt="">
                                        <h3>Gary Dawson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-1.png" alt="">
                                        <h3>Clyde Williamson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-2.png" alt="">
                                        <h3>Vernon Ray</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-3.png" alt="">
                                        <h3>Gary Dawson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-1.png" alt="">
                                        <h3>Clyde Williamson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-2.png" alt="">
                                        <h3>Vernon Ray</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="testimonials-one__box">
                                    <p><span>I was very impresed by the company service lore ipsum is simply free text used by copy typing refreshing. Neque porro est dolorem ipsum quia.</span></p>
                                    <div class="testimonials-one__box-info">
                                        <img src="assets/images/resources/testimonials-1-3.png" alt="">
                                        <h3>Gary Dawson</h3>
                                        <span>Analytics</span>
                                    </div><!-- /.testimonials-one__box-info -->
                                </div><!-- /.testimonials-one__box -->
                            </div><!-- /.swiper-slide -->
                        </div><!-- /.swiper-wrapper -->
    
                        <div class="testimonials-one__swiper-pagination swiper-pagination"></div><!-- /.testimonials-one__swiper-pagination swiper-pagination -->
                    </div><!-- /.thm-swiper__slider -->
                </div><!-- /.container -->
            </section><!-- /.testimonials-one -->





        
@endsection