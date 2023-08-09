@extends('user.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">@lang('user.Subscriptions')</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                <div class="clearfix"></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>
            @forelse($subscriptions as $index=>$subscription)
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">{!! $subscription->service->title !!}</h4>
                                <p>
                                    {!! $subscription->service->short_description !!}
                                </p>
                                <b>{!! $subscription->count_used !!}/{!! $subscription->count !!} @lang('user.Used')</b>
                                <p>@lang('user.Trial_Ends_At') {!! \Carbon\Carbon::create($subscription->trial_ends_at)->toFormattedDateString() !!}</p>
                                @if(!empty($subscription->ends_at))
                                    <p>@lang('user.Ends_At') {!! \Carbon\Carbon::create($subscription->ends_at)->toFormattedDateString() !!}</p>
                                @endif

                                @if($subscription->is_active || empty($subscription->ends_at))
                                    <button class="btn btn-primary me-2 mt-2" data-toggle="modal" data-target="#subscriptionModal_{!! $subscription->id !!}">@lang('user.Cancel_subscription')</button>
                                @else
                                    <button disabled class="btn btn-primary me-2 mt-2">@lang('user.Canceled_subscription')</button>
                                @endif
                            </div>
                            <div>
                                <span>{!! $subscription->service->price_btn_3 !!}$</span>
                                <p>@lang('user.Monthly') <br> @lang('user.Subscription')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="subscriptionModal_{!! $subscription->id !!}" tabindex="-1" aria-labelledby="subscriptionModalLabel_{!! $subscription->id !!}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <div class="modal-body">
                            <h4 class="modal-title mb-3">@lang('user.Cancel_Subscription')</h4>
                            <p>@lang('user.Are_you_sure_you_want_to_cancel_your_subscription')?</p>
                            <div class="mt-3">
                                <form action="{!! route('User::subscriptions.cancel', $subscription->id) !!}" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('user.Dont_Cancel')</button>
                                    <button type="submit" class="btn btn-secondary text-white">@lang('user.Yes_Cancel')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <p>@lang('user.No_subscriptions_added')</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
    <!-- content-wrapper ends -->
@endsection
