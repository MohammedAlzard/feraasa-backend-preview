@extends('layouts.master')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . trans('site.About_Us'))
@section('content')

    <section class="page-header" style="background-image: url('/website/images/top-banner-image.jpg');">
        <h2>@lang('site.About_Us')</h2>
    </section>

    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="image">
                        <img src="{!! \App\Helpers\HelpersFun::settings()->about_section_image !!}" />
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="content">
                        <h2 class="title">{!! \App\Helpers\HelpersFun::settings()->about_section_title !!}</h2>
                        <div class="body">
                            {!! \App\Helpers\HelpersFun::settings()->about_section_short_description !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <!-- <h3>What is Lorem Ipsum?</h3> -->
                    {!! \App\Helpers\HelpersFun::settings()->about_page_full_description !!}
                </div>
            </div>
        </div>
    </section>

@endsection
