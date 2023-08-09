@extends('admin.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('admin.Create_Testimonial')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'Admin::testimonials.store', 'enctype'=>'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.testimonials.fields-create')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(trans('admin.Save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('Admin::testimonials.index') }}" class="btn btn-default">@lang('admin.Cancel')</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
