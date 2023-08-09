<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="/user-dashboard/vendors/feather/feather.css">
    <link rel="stylesheet" href="/user-dashboard/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/user-dashboard/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/user-dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/user-dashboard/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/user-dashboard/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/user-dashboard/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/user-dashboard/images/favicon.ico"/>

    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>


    @if(app()->getLocale() == 'ar')
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">

        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{!! asset('/user-dashboard/css/rtl.css') !!}">
        <link rel="stylesheet" href="{!! asset('/user-dashboard/css/responsive-rtl.css') !!}">
    @endif

    <style>
        @media (max-width: 769px) {
            .coupon-box .coupon-input .typeahead {
                margin-top: 10px !important;
            }

            .coupon-box .coupon-input .btn-apply {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .btn-continue {
                margin: 0 !important;
            }

            form .card .card-body label{
                /*text-align: right !important;*/
                font-size: 14px;
            }
        }

        @media (max-width: 375px){
            .nav-tabs .nav-link {
                padding: 0.75rem 0.4rem;
            }
        }
    </style>
    @stack('page_css')
</head>
<body>
<div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{!! url('/') !!}">
                <img src="/user-dashboard/images/user-logo.png" class="" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{!! url('/') !!}">
                <img src="/user-dashboard/images/user-logo.png" alt="logo"/>
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                        <img src="/{!! app()->getLocale() !!}.png">
                        @lang('user.'.app()->getLocale())
                        <i class="fa fa-angle-down"></i>
                        {{--<i class="icon-bell mx-0"></i>--}}
                        {{--<span class="count"></span>--}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <a href="{!! url('/locale/en') !!}" class="dropdown-item preview-item">
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">
                                    <img src="/en.png" alt="" />
                                    English
                                </h6>
                            </div>
                        </a>
                        <a href="{!! url('/locale/ar') !!}" class="dropdown-item preview-item">
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">
                                    <img src="/ar.png" alt="" />
                                    العربية
                                </h6>
                            </div>
                        </a>
                    </div>
                </li>


                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="{!! Auth::user()->avatar !!}" alt="profile"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{!! route('User::settings.index') !!}">
                            <i class="ti-settings text-primary"></i>
                            @lang('user.Settings')
                        </a>
                        <a class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti-power-off text-primary"></i>
                            @lang('user.Logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">

        @include('user.layouts.sidebar')

        <div class="main-panel">

            @yield('content')

            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© {!! date('Y') !!} <a
                            href="{!! url('/') !!}"
                            target="_blank">{!! env('APP_NAME') !!}</a>. @lang('user.All_rights_reserved').</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->

    </div>
    <!-- page-body-wrapper ends -->

</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="/user-dashboard/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="/user-dashboard/vendors/chart.js/Chart.min.js"></script>
<script src="/user-dashboard/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="/user-dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="/user-dashboard/js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/user-dashboard/js/off-canvas.js"></script>
<script src="/user-dashboard/js/hoverable-collapse.js"></script>
<script src="/user-dashboard/js/template.js"></script>
<script src="/user-dashboard/js/settings.js"></script>
<script src="/user-dashboard/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/user-dashboard/js/dashboard.js"></script>
<script src="/user-dashboard/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- Toastr -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@stack('page_scripts')
</body>
</html>


