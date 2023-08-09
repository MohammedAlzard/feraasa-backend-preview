<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        body{
            direction: rtl;
        }
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">

                <!-- Start - Header -->
                <tr>
                    <td class="header">
                        <a href="{!! url('/') !!}" style="display: inline-block;">
                            <img src="{!! asset('website/images/logo-mail.png') !!}" class="logo" alt="{!! env('APP_NAME') !!}">
                        </a>
                    </td>
                </tr>
                <!-- End - Header -->

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 15px">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="text-align: center;">
                                    <img width="50px" src="{!! asset('website/images/mail.png') !!}" alt="Icon E-Mail"/>
                                    <h4 style="color: #413F3F;">تم انتهاء القراءة بنجاح</h4>
                                    <hr>
                                    <h4 style="color: #237CD5;">{!! $data['title_service'] !!}</h4>
                                    <hr>
                                    <h4 style="color: #237CD5;">الحالة: {!! trans('user.'.$data['status']) !!}</h4>

                                    {{--<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td>
                                                subcopy
                                            </td>
                                        </tr>
                                    </table>--}}

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="text-align: center;">
                                    <img width="50px" src="{!! asset('website/images/invoice-2.png') !!}" alt="Icon E-Mail"/>
                                    <h4 style="color: #413F3F;">النتيجة</h4>
                                    <div>
                                        <a href="{!! $data['url'] !!}" target="_blank" style="background: #0b7dfd; color: #fff;border-radius: 20px; padding: 5px 20px;text-decoration: none;">فتح الطلب</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Start - Footer -->
                <tr>
                    <td>
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell" align="center">
                                    {{--© 2023 Al Feraasa. All rights reserved.--}}
                                    OLOOM LTD
                                    <br>
                                    Company No. 14286078
                                    <br>
                                    71-75 Shelton Street, Covent Garden, London, United Kingdom, WC2H 9JQ
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- End - Footer -->
            </table>
        </td>
    </tr>
</table>
</body>
</html>
