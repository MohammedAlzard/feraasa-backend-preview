@extends('user.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">@lang('user.Settings')</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('user.Personal_Information')</h4>
                        <!-- <p class="card-description">
                          Basic form elements
                        </p> -->

                        @include('flash::message')
                        @include('adminlte-templates::common.errors')
                        <div class="clearfix"></div>

                        <form action="{!! route('User::settings.update') !!}" method="post" class="forms-sample"
                              enctype="multipart/form-data">
                            @csrf

                            {{--<div class="form-group">
                                <label>@lang('user.Avatar')</label>
                                <input id="avatar" type="file" name="avatar" class="file-upload-default">
                                <div class="input-group col-xs-8">
                                    <input type="text" class="form-control file-upload-info" disabled="" value="{!! explode("/uploads/user/profile/", Auth::user()->avatar)[1] !!}" placeholder="@lang('user.Upload_Image')">
                                    <span class="input-group-append">
                                      <label for="avatar" class="file-upload-browse btn btn-primary">@lang('user.Upload')</label>
                                    </span>
                                </div>
                            </div>--}}

                            <div class="row align-items-center">
                                <div class="col-md-9 form-group">
                                    <label>@lang('user.Picture')</label>
                                    <input id="avatar" type="file" name="avatar" class="file-upload-default">
                                    <div class="input-group">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                               value=""
                                               placeholder="@lang('user.Upload_Picture')">
                                        <span class="input-group-append">
                                      <label for="avatar"
                                             class="file-upload-browse btn btn-primary">@lang('user.Change_a_Profile_Picture')</label>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group m-auto">
                                    <img id="previewImg" class="img-fluid" src="{!! Auth::user()->avatar !!}" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputFirstName">@lang('user.First_Name')</label>
                                    <input type="text" class="form-control" id="exampleInputFirstName" name="first_name"
                                           placeholder="@lang('user.First_Name')" value="{!! $user->first_name !!}"
                                           required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputLastName">@lang('user.Last_Name')</label>
                                    <input type="text" class="form-control" id="exampleInputLastName" name="last_name"
                                           placeholder="@lang('user.Last_Name')" value="{!! $user->last_name !!}"
                                           required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputDate">@lang('user.Date_of_Birth')</label>
                                    <input type="date" class="form-control" id="exampleInputDate" name="date_of_birth"
                                           placeholder="@lang('user.Date_of_Birth')"
                                           value="{!! $user->date_of_birth !!}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputMobile">@lang('user.Mobile_Phone')</label>
                                    <input type="text" class="form-control" id="exampleInputMobile" name="phone"
                                           placeholder="@lang('user.Mobile_Phone')" value="{!! $user->phone !!}"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">@lang('user.Email_Address')</label>
                                <input type="email" class="form-control" id="exampleInputEmail3" name="email"
                                       placeholder="@lang('user.Email_Address')" value="{!! $user->email !!}" required>
                            </div>

                            {{--<div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputOldPassword">Old Password</label>
                                    <input type="password" class="form-control" id="exampleInputOldPassword" name="old_password" autocomplete="false" placeholder="Old Password">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputNewPassword">New Password</label>
                                    <input type="password" class="form-control" id="exampleInputNewPassword" name="new_password" placeholder="New Password">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputOldPassword" name="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>--}}

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    @lang('user.Password_Reset'), <a
                                        href="{{ route('password.request') }}">@lang('user.Click_here')</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">@lang('user.Submit')</button>
                            <a href="{!! url('/home') !!}" class="btn btn-light">@lang('user.Cancel')</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
@endsection

@push('page_scripts')
    <script>
        $('#exampleInputDate').attr('max', new Date().toISOString().split('T')[0])

        $("input#avatar").change(function(){
            var fileNameAvatar = $('input#avatar').val().match(/[^\\/]*$/)[0];
            $('.file-upload-info').val(fileNameAvatar);

            var file = $("input#avatar").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }


            Command: toastr["info"]("{!! trans('user.Click_the_Submit_button_to_save_the_changes') !!}")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
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
            // contactForm[0].reset();

        });
    </script>
@endpush
