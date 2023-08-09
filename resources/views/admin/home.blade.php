@extends('admin.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('admin.Dashboard')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! route('Admin::home.index') !!}">@lang('admin.Dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('admin.Home')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3>{!! $usersCount !!}</h3>
                        <p>@lang('admin.Users')</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('Admin::users.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{!! $servicesCount !!}</h3>
                        <p>@lang('admin.Services')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-table"></i>
                    </div>
                    <a href="{{ route('Admin::services.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{!! $ordersCount !!}</h3>
                        <p>@lang('admin.Orders')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                    </div>
                    <a href="{{ route('Admin::orders.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3>{!! $reviewsCount !!}</h3>
                        <p>@lang('admin.Reviews')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-star"></i>
                    </div>
                    <a href="{{ route('Admin::reviews.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{!! $newslettersCount !!}</h3>
                        <p>@lang('admin.Newsletters')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-at"></i>
                    </div>
                    <a href="{{ route('Admin::newsletters.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{!! $contactsCount !!}</h3>
                        <p>@lang('admin.Contacts')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-envelope"></i>
                    </div>
                    <a href="{{ route('Admin::contacts.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>${!! $salesSum !!}</h3>
                    <p>@lang('admin.Sales')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
                <a href="{{ route('Admin::orders.index') }}" class="small-box-footer">@lang('admin.More_info') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-8">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">@lang('admin.Users_Line_Chart') </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-4">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">@lang('admin.Users_Chart')</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection



@push('page_scripts')
    
@endpush
