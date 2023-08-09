@extends('admin.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('admin.Profile')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! route('Admin::home.index') !!}">@lang('admin.Dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('admin.Admin_Profile')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">

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
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-green card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{!! $auth->avatar !!}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{!! $auth->name !!}</h3>
                        {{--<p class="text-muted text-center">{!! $auth->job !!}</p>--}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-green card-outline">
                    <div class="card-body">
                        <form class="form-horizontal" action="{!! route('Admin::profile.update') !!}"  method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">@lang('admin.Avatar')</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="inputAvatar" name="avatar" accept="image/*">
                                    {{--@error('avatar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">@lang('admin.Username')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="inputUsername" name="username" placeholder="@lang('admin.Username')" value="{!! $auth->username !!}" required>
                                    {{--@error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputFirst_Name" class="col-sm-2 col-form-label">@lang('admin.Name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputUsername" name="name" placeholder="@lang('admin.Name')" value="{!! $auth->name !!}" required>
                                    {{--@error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">@lang('admin.Email')</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" placeholder="@lang('admin.Email')" value="{!! $auth->email !!}" disabled required>
                                    {{--@error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            @lang('admin.Password_Reset'), <a href="{{ route('admin.password.request') }}">@lang('admin.Click_here')</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">@lang('admin.Update')</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection
