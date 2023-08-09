<footer>
    <div class="footer-top">
        <div class="go-to-top">
            <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <a href="{!! url('/') !!}"><img class="logo" src="{!! \App\Helpers\HelpersFun::settings()->site_footer_logo !!}" /></a>
                    <p>
                        {!! \App\Helpers\HelpersFun::settings()->footer_description !!}
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>@lang('site.Links')</h3>
                    <ul>
                        <li><a href="{!! url('/home') !!}">@lang('site.Home')</a></li>
                        <li><a href="{!! url('/about') !!}">@lang('site.About')</a></li>
                        <li><a href="{!! url('/services') !!}">@lang('site.Services')</a></li>
                        <li><a href="/#testimonials">@lang('site.Testimonial')</a></li>
                        <li><a href="{!! url('/contact') !!}">@lang('site.Contact_us')</a></li>
                    </ul>
                    <ul>
                        <li><a href="{!! url('/login') !!}">@lang('site.Login')</a></li>
                        <li><a href="{!! url('/reviews') !!}">@lang('site.Reviews')</a></li>
                        <li><a href="{!! url('/term-and-condition') !!}">@lang('site.Term_Condition')</a></li>
                        <li><a href="{!! url('/privacy-and-policy') !!}">@lang('site.Privacy_and_Policy')</a></li>
                        <li><a href="{!! url('/refund-policy') !!}">@lang('site.Refund_Policy')</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>@lang('site.DONT_MISS_A_THING')</h3>
                    <p class="pt-2">{!! \App\Helpers\HelpersFun::settings()->newsletter_description !!}</p>
                    <form id="newsletterForm">
                        <input type="email" id="email" name="email" placeholder="@lang('site.Email_Address')" required />
                        <button type="submit"><i class="fa fa-envelope"></i></button>
                        <span id="emailErrorMsg" class="clearfix text-red"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <p>{!! \App\Helpers\HelpersFun::settings()->copyright !!}</p>
                </div>
                <div>
                    <ul>
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_facebook))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_facebook !!}" target="_blank"><i class="fab fa-facebook"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_twitter))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_twitter !!}" target="_blank"><i class="fab fa-twitter"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_behance))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_behance !!}" target="_blank"><i class="fab fa-behance"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_dribbble))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_dribbble !!}" target="_blank"><i class="fab fa-dribbble"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_linkedin))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_linkedin !!}" target="_blank"><i class="fab fa-linkedin"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_instagram))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_instagram !!}" target="_blank"><i class="fab fa-instagram"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_youtube))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_youtube !!}" target="_blank"><i class="fab fa-youtube"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_whatsapp))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_whatsapp !!}" target="_blank"><i class="fab fa-whatsapp"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_vimeo))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_vimeo !!}" target="_blank"><i class="fab fa-vimeo"></i></a> </li>
                        @endif
                        @if(!empty(\App\Helpers\HelpersFun::settings()->url_rss))
                            <li><a href="{!! \App\Helpers\HelpersFun::settings()->url_rss !!}" target="_blank"><i class="fab fa-rss"></i></a> </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
