<nav class="navbar navbar-expand-xl navbar-light ">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-xl-none" href="{!! url('/') !!}">
            <img class="logo" src="{!! \App\Helpers\HelpersFun::settings()->site_header_logo !!}" />
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarClassicCollapse" aria-controls="navbarClassicCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarClassicCollapse">

            <!-- Nav -->
            <ul class="navbar-nav navbar-left">
                <li class="nav-item"><a class="nav-link {!! isset($isActiveHomePage) ? 'active' : '' !!}" href="{!! url('/') !!}">@lang('site.Home')</a></li>
                <li class="nav-item"><a class="nav-link {!! isset($isActiveAboutPage) ? 'active' : '' !!}" href="{!! url('/about') !!}">@lang('site.About_Us')</a></li>
                <li class="nav-item"><a class="nav-link {!! isset($isActiveServicesPage) ? 'active' : '' !!}" href="{!! url('/services') !!}">@lang('site.Services')</a></li>
                {{--<li class="nav-item"><a class="nav-link" href="/#testimonials">@lang('site.Testimonial')</a></li>--}}
                <li class="nav-item"><a class="nav-link {!! isset($isActiveReviewsPage) ? 'active' : '' !!}" href="{!! url('/reviews') !!}">@lang('site.Reviews')</a></li>
                <li class="nav-item"><a class="nav-link {!! isset($isActiveContactPage) ? 'active' : '' !!}" href="{!! url('/contact') !!}">@lang('site.Contact_Us')</a></li>
            </ul>

            <!-- Brand -->
            <a class="navbar-brand mx-auto d-none d-xl-block" href="{!! url('/') !!}">
                <img class="logo" src="{!! \App\Helpers\HelpersFun::settings()->site_header_logo !!}" />
            </a>

            <!-- Nav -->
            <ul class="navbar-nav nav-divided navbar-right">
                <li class="nav-item"><a class="nav-link {!! isset($isActiveTermAndConditionPage) ? 'active' : '' !!}" href="{!! url('/term-and-condition') !!}">@lang('site.Term_and_Condition')</a></li>
                <li class="nav-item"><a class="nav-link {!! isset($isActivePrivacyAndPolicyPage) ? 'active' : '' !!}" href="{!! url('/privacy-and-policy') !!}">@lang('site.Privacy_and_Policy')</a></li>

                @if (Route::has('login'))
                    <li class="nav-item">
                        @if(Auth::guard('admin')->check())
                            <a class="nav-link login" href="{!! url('/admin/home') !!}">@lang('site.My_Account')</a>
                        @elseif(Auth::guard('web')->check())
                            @if(!Auth::guard('web')->user()->hasVerifiedEmail())
                                {{--<a class="nav-link login" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('site.Logout')</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>--}}
                                <a class="nav-link login" href="{!! url('/home') !!}">@lang('site.My_Account')</a>
                            @else
                                <a class="nav-link login" href="{!! url('/home') !!}">@lang('site.My_Account')</a>
                            @endif
                        @else
                            <a class="nav-link login" href="{!! url('/login') !!}">@lang('site.Login')</a>
                        @endif
                    </li>
                @endif

                <li class="nav-item">
                    @if(app()->getLocale() == 'en')
                        <a class="nav-link" href="{!! url('/locale/ar') !!}" title="@lang('site.Arabic')"><i class="fa fa-globe"></i></a>
                    @else
                        <a class="nav-link" href="{!! url('/locale/en') !!}" title="@lang('site.English')"><i class="fa fa-globe"></i></a>
                    @endif
                </li>
            </ul>
        </div>

    </div>
</nav>
