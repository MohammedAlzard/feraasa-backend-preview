@extends('layouts.master')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . trans('site.Privacy_and_Policy'))
@section('content')

    <section class="page-header" style="background-image: url('/website/images/top-banner-image.jpg');">
        <h2>@lang('site.Privacy_and_Policy')</h2>
    </section>

    <section class="term-and-condition">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('site.Privacy_and_Policy')</h2>
                    {!! \App\Helpers\HelpersFun::settings()->content_privacy_and_policy !!}
                </div>
            </div>
        </div>
    </section>

@endsection
