@extends('user.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">@lang('user.Welcome'), {!! Auth::user()->name !!}</h3>
                        <h6 class="font-weight-normal mb-0">{!! \Carbon\Carbon::create(Auth::user()->last_logged_in)->toFormattedDateString() !!}</h6>
                    </div>
                </div>
                @if (session('error'))
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group text-left'>
                            <div class='alert-danger alert'>{!! session('error') !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">@lang('user.Total_Subscriptions')</p>
                                <p class="fs-30 mb-2">{!! $subscriptionsCount !!}</p>
                                <h4 class="pt-2"><a style="color: #ffffff;" href="{!! route('User::subscriptions.index') !!}" class="small-box-footer">@lang('user.More_Info')</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">@lang('user.Total_Orders')</p>
                                <p class="fs-30 mb-2">{!! $ordersCount !!}</p>
                                <h4 class="pt-2"><a style="color: #ffffff;" href="{!! route('User::orderHistory.index') !!}" class="small-box-footer">@lang('user.More_Info')</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">@lang('user.Total_Payments')</p>
                                <p class="fs-30 mb-2">${!! $total_Payments !!}</p>
                                {{--<p>from Register to Now</p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">@lang('user.Orders_on_Hold')</p>
                                <p class="fs-30 mb-2">{!! $ordersOn_HoldCount !!}</p>
                                <h4 class="pt-2"><a style="color: #ffffff;" href="{!! route('User::orderHistory.index') !!}" class="small-box-footer">@lang('user.More_Info')</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">@lang('user.Last_Orders')</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th>@lang('user.Service_Title')</th>
                                    <th>@lang('user.Status')</th>
                                    <th>@lang('user.Date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{!! route('User::orderHistory.index') !!}">{!! $order->service->title !!}</a></td>
                                    <td class="font-weight-medium">
                                        @if($order->status == 'On_Hold')
                                            <span class="badge badge-warning">@lang('user.On_Hold')</span>
                                        @else
                                            <span class="badge badge-success">@lang('user.Done')</span>
                                        @endif
                                    </td>
                                    <td>{!! $order->created_at->toFormattedDateString() !!}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row services d-flex justify-content-center">
            <div class="raw">
                <h2 class="title wow fadeInUp text-white" data-wow-delay="0.1s" data-wow-duration="1500ms">{!! trans('site.Services') !!}</h2>
            </div>
            <div class="row">
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

    </div>
    <!-- content-wrapper ends -->
@endsection
