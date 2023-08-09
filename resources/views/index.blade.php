@extends('layouts.master')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . trans('site.Home'))
@section('content')

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1">
                    <h1 class="title wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1500ms">{!! \App\Helpers\HelpersFun::settings()->main_section_title !!}</h1>
                    <p class="description wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1500ms">
                        {!! \App\Helpers\HelpersFun::settings()->main_section_description !!}
                    </p>
                </div>

                <div class="col-md-6 text-center order-1 order-md-2">
                    <lottie-player class="lottie-player" src="https://assets5.lottiefiles.com/packages/lf20_t9mjd9.json" background="transparent"  speed="1"   loop  autoplay></lottie-player>
                    <!--<img class="rotating" width="90%" src="/website/images/loop.png" />-->
                </div>
            </div>
        </div>
    </section>

    <section class="services">

        <div class="container">
            <h2 class="title wow fadeInUp text-white" data-wow-delay="0.1s" data-wow-duration="1500ms">{!! trans('site.Services') !!}</h2>
            <div class="row d-flex justify-content-center">

                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="{!! url('/services/'.$service->slug) !!}">
                        <div class="card">
                            @if ($loop->index === 1)
                            <!--<div class="ribbon ribbon-top-right"><span>الأكثر شيوعا</span></div>-->
                            @endif
                            <div class="card-wrapper" >
                                <div class="card-image" style="background: url('{!! $service->background !!}') center;background-size: cover;height: 400px;width: 100%;border-radius: 10px;border: 1px solid rgba(255,255,255, 0.255);"> </div>
                                <h1> {!! $service->title !!}</h1>
                                <p>{!! $service->short_description !!}</p>
                            </div>
                            <div class="button-wrapper">
                                <button class="card-btn fill">@lang('site.Order_Now')</button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="about ">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-2 order-md-1">
                    <div class="image">
                        <img src="{!! \App\Helpers\HelpersFun::settings()->about_section_image !!}" />
                    </div>
                </div>
                <div class="col-md-7 order-1 order-md-2">
                    <div class="content">
                        <h2 class="title wow fadeInUp text-white" data-wow-delay="0.1s" data-wow-duration="1500ms">{!! \App\Helpers\HelpersFun::settings()->about_section_title !!}</h2>
                        <div class="body wow fadeInUp text-white" data-wow-delay="0.2s" data-wow-duration="1500ms">
                            <p>
                                {!! \App\Helpers\HelpersFun::settings()->about_section_short_description !!}
                            </p>
                        </div>
                        <a href="{!! url('/about') !!}" class="btn btn-primary btn-radius wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1500ms">@lang('site.About_Us')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="slider owl-carousel">

                @foreach($testimonials as $index=>$testimonial)
                <div class="item">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="image wow fadeIn">
                                <img src="{!! $testimonial->image !!}" data-wow-delay="0.3s" data-wow-duration="1500ms" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="py-5">
                                <i class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1500ms">،،</i>
                                <p class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1500ms">
                                    {!! $testimonial->description !!}
                                </p>
                                <h3 class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1500ms">{!! $testimonial->name !!}</h3>
                                <h6 class="wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1500ms">{!! $testimonial->job !!}</h6>
                                <div class="count pt-4 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1500ms">
                                    <span>{!! $index+=1 !!}</span>/{!! count($testimonials) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var fields = $('section.main .item'),
            container = $('section.main .image-container'),
            width = container.width(),
            height = container.height();
            radius = (container.width() /2) - 40;
        var angle = 0,
            step = (2 * Math.PI) / fields.length;
        fields.each(function () {
            var x = Math.round(width / 2 + radius * Math.cos(angle) - $(this).width() / 2);
            var y = Math.round(height / 2 + radius * Math.sin(angle) - $(this).height() / 2);
            if (window.console) {
                console.log($(this).text(), x, y);
            }
            $(this).css({
                left: x + 'px',
                top: y + 'px'
            });
            angle += step;
        });
    });
</script>
@endsection
