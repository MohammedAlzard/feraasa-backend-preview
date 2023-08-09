<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{!! \App\Helpers\HelpersFun::settings()->site_favicon !!}" type="image/x-icon">
    <meta name="description"
          content="متخصص في علم الفراسة الذي يعمل من خلال تحديد شخصية الشخص من خلال ملامح الوجه ودراستها"/>

    <link href="/website/css/bootstrap.min.css" rel="stylesheet">
    <script src="/website/js/kit.fontawesome.com_9df013a202.js" crossorigin="anonymous"></script>
    <!-- Animate wow js -->
    <link rel="stylesheet" href="/website/animate/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/website/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/website/owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/website/css/style.css">
    <link rel="stylesheet" href="/website/css/responsive.css">

    @if(app()->getLocale() == 'ar')
        <!-- Bootstrap 5 RTL -->
        <link rel="stylesheet" href="/website/css/bootstrap.rtl.min.css">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{!! asset('/website/css/rtl.css') !!}">
        <link rel="stylesheet" href="{!! asset('/website/css/responsive-rtl.css') !!}">
    @endif

    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type='text/javascript'>
        window.smartlook || (function (d) {
            var o = smartlook = function () {
                o.api.push(arguments)
            }, h = d.getElementsByTagName('head')[0];
            var c = d.createElement('script');
            o.api = new Array();
            c.async = true;
            c.type = 'text/javascript';
            c.charset = 'utf-8';
            c.src = 'https://web-sdk.smartlook.com/recorder.js';
            h.appendChild(c);
        })(document);
        smartlook('init', '58eae022e4c43d9356b7215f12ce59887f98b98d', {
            region: 'eu',
            advancedNetwork: {
                allowedUrls: [new RegExp("^https://feraasa.com/")],
                allowedHeaders: ['x-custom-header'],
            },
            interceptors: {
                network: (data, context) => {
                    const tokenIndex = data.url.indexOf('token=');
                    if (tokenIndex > -1) {
                        data.url = data.url.slice(0, tokenIndex) + 'token=[OBSCURED]';
                    }
                }
            }
        });
    </script>
</head>
<body>


<!-- ========== HEADER ========== -->
@include('layouts.header')
<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
@yield('content')
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== FOOTER ========== -->
@include('layouts.footer')
<!-- ========== END FOOTER ========== -->

<script src="/website/js/jquery-3.6.0.min.js"></script>
<script src="/website/js/bootstrap.bundle.min.js"></script>
<!-- Animate wow js -->
<script src="/website/animate/wow.min.js"></script>
<!-- Owl Carousel -->
<script src="/website/owlcarousel/owl.carousel.min.js"></script>
<script src="/website/js/script.js"></script>

<!-- Toastr -->
<script type="text/javascript" src="/website/js/toastr.min.js"></script>
<script src="/website/js/lottie-player.js"></script>
<script>
    let newsletterForm = $('#newsletterForm');
    newsletterForm.on('submit', function (e) {
        e.preventDefault();

        let email = $("input#email").val();

        $.ajax({
            url: "/newsletter",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                email: email,
            },
            success: function (response) {
                $('#emailErrorMsg').text('');

                Command: toastr["success"](response.success)
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
                newsletterForm[0].reset();
            },
            error: function (response) {
                $('#emailErrorMsg').text(response.responseJSON.errors.email);
            },
        });
    });
</script>

@if(app()->getLocale() == 'ar')
    <script>
        $(document).ready(function () {

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                rtl: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })

        });
    </script>
@else
    <script>
        $(document).ready(function () {

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })

        });
    </script>
@endif

@yield('scripts')
</body>
</html>
