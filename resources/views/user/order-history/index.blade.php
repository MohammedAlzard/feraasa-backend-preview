@extends('user.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">@lang('user.Order_History')</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Order History</h4> -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        @lang('user.Order')
                                    </th>
                                    <th>
                                        @lang('user.Name_of_Order')
                                    </th>
                                    <th>
                                        @lang('user.Status')
                                    </th>
                                    <th>
                                        @lang('user.Date')
                                    </th>
                                    <th>
                                        @lang('user.Action')
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="py-1">
                                            {!! $order->order_number !!}
                                        </td>
                                        <td>
                                            {!! $order->service_title !!}
                                            {{--{!! $order->user ? $order->user->first_name . ' '. $order->user->last_name : 'Undefined' !!}--}}
                                        </td>
                                        <td>
                                            @if($order->status == 'On_Hold')
                                                <span class="badge badge-warning">@lang('user.On_Hold')</span>
                                            @else
                                                <span class="badge badge-success">@lang('user.Done')</span>
                                            @endif
                                        </td>
                                        <td>
                                            {!! $order->created_at->toFormattedDateString() !!}
                                        </td>

                                        <td>
                                            @if(!empty($order->answer) && $order->status != 'On_Hold')
                                                <a class="btn btn-primary py-2"
                                                   href="{!! url($order->answer->image) !!}"
                                                   target="_blank">@lang('user.Open')</a>

                                                <button id="btnShareDefaultModal_{{$order->id}}" type="button"
                                                        class="btn btn-outline-behance py-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#shareDefaultModal_{{$order->id}}"><i class="fa fa-share-alt"></i> @lang('user.Share')
                                                </button>
                                                <div class="modal fade" id="shareDefaultModal_{{$order->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel{{$order->id}}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{$order->id}}">@lang('user.share_your_image_on_facebook')</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                {{--<ul class="share">
                                                                    <li>
                                                                        <a class="btn btn-outline-facebook btn-fw py-2 mb-2"
                                                                           href="https://www.facebook.com/share.php?u={!! url($order->answer->image) !!}"
                                                                           target="_blank"> <i class="fa fa-facebook"></i> Facebook </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-twitter btn-fw py-2 mb-2"
                                                                           href="https://twitter.com/share?text=NULL&url={!! url($order->answer->image) !!}"
                                                                           target="_blank"><i class="fa fa-twitter"></i> Twitter </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-linkedin btn-fw py-2 mb-2"
                                                                           href="https://www.linkedin.com/shareArticle/?mini=true&title=NULL&url={!! url($order->answer->image) !!}"
                                                                           target="_blank"><i class="fa fa-linkedin"></i> Linkedin </a>
                                                                    </li>

                                                                    <li>
                                                                        <a class="btn btn-outline-telegram btn-fw py-2 mb-2"
                                                                           href="https://telegram.me/share/url?url={!! url($order->answer->image) !!}"
                                                                           target="_blank"><i class="fa fa-telegram"></i> Telegram </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-google btn-fw py-2 mb-2"
                                                                           href="mailto:?subject=NULL&body={!! url($order->answer->image) !!}"
                                                                           target="_blank"><i class="fa fa-envelope"></i> Email </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-whatsapp btn-fw py-2 mb-2"
                                                                           href="https://api.whatsapp.com/send?text=NULL, {!! url($order->answer->image) !!}"
                                                                           target="_blank"><i class="fa fa-whatsapp"></i> WhatsApp </a>
                                                                    </li>
                                                                </ul>--}}

                                                                <ul class="share">
                                                                    <li>
                                                                        <a class="btn btn-outline-facebook btn-fw py-2 mb-2"
                                                                           href="https://www.facebook.com/share.php?u={!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"> <i class="fa fa-facebook"></i> Facebook </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-twitter btn-fw py-2 mb-2"
                                                                           href="https://twitter.com/share?text=&url={!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"><i class="fa fa-twitter"></i> Twitter </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-linkedin btn-fw py-2 mb-2"
                                                                           href="https://www.linkedin.com/shareArticle/?mini=true&title=&url={!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"><i class="fa fa-linkedin"></i> Linkedin </a>
                                                                    </li>

                                                                    <li>
                                                                        <a class="btn btn-outline-telegram btn-fw py-2 mb-2"
                                                                           href="https://telegram.me/share/url?url={!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"><i class="fa fa-telegram"></i> Telegram </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-google btn-fw py-2 mb-2"
                                                                           href="mailto:?subject=&body={!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"><i class="fa fa-envelope"></i> Email </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn btn-outline-whatsapp btn-fw py-2 mb-2"
                                                                           href="https://api.whatsapp.com/send?text=, {!! url('/r/'.$order->answer->report_id) !!}"
                                                                           target="_blank"><i class="fa fa-whatsapp"></i> WhatsApp </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            {{--<a href="{!! url('/home/order-history/'.$order->id.'/write-review') !!}" class="btn btn-outline-warning py-2">@lang('user.Write_a_Review)</a>--}}
                                            @if(empty($order->review))
                                                @if($order->status != 'On_Hold')
                                                    <button id="btnDefaultModal_{{$order->id}}" type="button"
                                                            class="btn btn-outline-warning py-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#defaultModal_{{$order->id}}">@lang('user.Write_a_Review')
                                                    </button>
                                                    <div class="modal fade" id="defaultModal_{{$order->id}}"
                                                         tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel{{$order->id}}"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel{{$order->id}}">@lang('user.Write_a_Review_of')
                                                                        {!! $order->service->title !!}</h5>
                                                                    <button type="button" class="close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <form id="ratingForm_{!! $order->id !!}">
                                                                    <div class="modal-body pb-0">
                                                                        <input type="hidden" class="order_id"
                                                                               name="order_id"
                                                                               value="{!! $order->id !!}">
                                                                        <input type="hidden" class="service_id"
                                                                               name="service_id"
                                                                               value="{!! $order->service->id !!}">

                                                                        <span
                                                                            class="text-danger order_idErrorMsg d-block mb-2"></span>
                                                                        <span
                                                                            class="text-danger service_idErrorMsg d-block mb-2"></span>

                                                                        <div class='form-group'>
                                                                            <label
                                                                                class='control-label'>@lang('user.Overall_Rating')</label>
                                                                            <br>
                                                                            <fieldset class="rating-input">
                                                                                <input type="radio" value="5"
                                                                                       id="stars-star5-{!! $order->id !!}"
                                                                                       class="rating" name="rating">
                                                                                <label
                                                                                    for="stars-star5-{!! $order->id !!}"
                                                                                    title="5 Stars"></label>
                                                                                <input type="radio" checked value="4"
                                                                                       id="stars-star4-{!! $order->id !!}"
                                                                                       class="rating" name="rating">
                                                                                <label
                                                                                    for="stars-star4-{!! $order->id !!}"
                                                                                    title="4 Stars"></label>
                                                                                <input type="radio" value="3"
                                                                                       id="stars-star3-{!! $order->id !!}"
                                                                                       class="rating" name="rating">
                                                                                <label
                                                                                    for="stars-star3-{!! $order->id !!}"
                                                                                    title="3 Stars"></label>
                                                                                <input type="radio" value="2"
                                                                                       id="stars-star2-{!! $order->id !!}"
                                                                                       class="rating" name="rating">
                                                                                <label
                                                                                    for="stars-star2-{!! $order->id !!}"
                                                                                    title="2 Stars"></label>
                                                                                <input type="radio" value="1"
                                                                                       id="stars-star1-{!! $order->id !!}"
                                                                                       class="rating" name="rating">
                                                                                <label
                                                                                    for="stars-star1-{!! $order->id !!}"
                                                                                    title="1 Stars"></label>
                                                                            </fieldset>
                                                                            <!-- partial -->
                                                                            <span
                                                                                class="text-danger ratingErrorMsg"></span>
                                                                        </div>

                                                                        <div class='form-group'>
                                                                            <label
                                                                                class='control-label'>@lang('user.Your_Review')</label>
                                                                            <textarea class="form-control review"
                                                                                      name="review" rows="8"
                                                                                      placeholder="@lang('user.Your_Review')"
                                                                                      required></textarea>
                                                                            <span
                                                                                class="text-danger reviewErrorMsg"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-secondary  text-white"
                                                                                data-bs-dismiss="modal">@lang('user.Close')
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-primary submitRating">@lang('user.Save')</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <button id="btnShowRatingModal_{{$order->id}}" type="button"
                                                        class="btn btn-outline-success py-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showRatingModal_{{$order->id}}">@lang('user.Show_a_Review')
                                                </button>
                                                <div class="modal fade" id="showRatingModal_{{$order->id}}"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel{{$order->id}}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{$order->id}}">@lang('user.Show_a_Review_of')
                                                                    {!! $order->service->title !!}</h5>
                                                                <button type="button" class="close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pb-0">
                                                                <div class='form-group'>
                                                                    <label
                                                                        class='control-label'>@lang('user.Overall_Rating')</label>
                                                                    <br>
                                                                    <ul class="rating-score"
                                                                        data-rating="{!! $order->review->rating !!}">
                                                                        <li class="rating-score-item"></li>
                                                                        <li class="rating-score-item"></li>
                                                                        <li class="rating-score-item"></li>
                                                                        <li class="rating-score-item"></li>
                                                                        <li class="rating-score-item"></li>
                                                                    </ul>
                                                                </div>

                                                                <div class='form-group'>
                                                                    <label
                                                                        class='control-label'>@lang('user.Your_Review')</label>
                                                                    <textarea class="form-control" rows="8"
                                                                              disabled>{!! $order->review->review !!}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                        class="btn btn-secondary text-white"
                                                                        data-bs-dismiss="modal">@lang('user.Close')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

@endsection


@push('page_scripts')
    <script>

        // $('[type*="radio"]').change(function () {
        //     $('[type*="radio"]').attr('checked', false)
        //     var me = $(this);
        //     me.attr('checked', true)
        //     // console.log(me.val());
        // });

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        /* get all form and loop foreach */
        $("form").each(function () {

            /* addEventListener onsubmit each form */
            $(this).bind("submit", function (event) {

                /* return false */
                event.preventDefault();

                /* display each props of forms */
                // console.log( event.target.id ); // object formHTML
                // console.log( "form id: " + event.target.id );
                // console.log( "form action: " + event.target.action );
                // console.log( "form method: " + event.target.method );

                let ratingFormId = event.target.id;
                // console.log(ratingFormId);

                let order_id = $("#" + ratingFormId + " input.order_id").val();
                let service_id = $("#" + ratingFormId + " input.service_id").val();
                let rating = $("#" + ratingFormId + " input.rating:checked").val();
                let review = $("#" + ratingFormId + " .review").val();

                // console.log(order_id);
                // console.log(rating);
                // console.log(review);

                $("#" + ratingFormId + ' .submitRating').attr('disabled', true);

                $.ajax({
                    url: "{!! route('User::store_write_review') !!}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        order_id: order_id,
                        service_id: service_id,
                        rating: rating,
                        review: review,
                    },
                    success: function (response) {

                        // let successMsg = $('#successMsg');
                        $("#" + ratingFormId + ' .order_idErrorMsg').text('');
                        $("#" + ratingFormId + ' .service_idErrorMsg').text('');
                        $("#" + ratingFormId + ' .ratingErrorMsg').text('');
                        $("#" + ratingFormId + ' .reviewErrorMsg').text('');
                        // successMsg.text(response.success);
                        // successMsg.show();
                        $("#" + ratingFormId)[0].reset();

                        $("#" + ratingFormId + ' .submitRating').attr('disabled', false);
                        $('#defaultModal_' + order_id).modal('hide');
                        $('#btnDefaultModal_' + order_id).attr('disabled', true);

                        Command: toastr["success"](response.success)

                        // contactForm[0].reset();
                    },
                    error: function (response) {
                        // console.log('test');
                        $("#" + ratingFormId + ' .submitRating').attr('disabled', false);
                        // $('#successMsg').hide();

                        if (response.responseJSON.errors.order_id != null || response.responseJSON.errors.service_id != null) {
                            Command: toastr["error"]("{!! trans('user.Please_try_Again') !!}")
                            setTimeout(function () {
                                location.reload();
                            }, 5000);
                        }

                        $("#" + ratingFormId + ' .order_idErrorMsg').text(response.responseJSON.errors.order_id);
                        $("#" + ratingFormId + ' .service_idErrorMsg').text(response.responseJSON.errors.service_id);
                        $("#" + ratingFormId + ' .ratingErrorMsg').text(response.responseJSON.errors.rating);
                        $("#" + ratingFormId + ' .reviewErrorMsg').text(response.responseJSON.errors.review);
                    },
                });

            });
        });
    </script>
@endpush
