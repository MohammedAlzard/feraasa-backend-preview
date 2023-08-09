@extends('admin.layouts.app')
@section('title', \App\Helpers\HelpersFun::settings()->site_title . ' | ' . $titlePage)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('admin.Edit_Contact')</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($contact, ['route' => ['Admin::contacts.update', $contact->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.contacts.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(trans('admin.Save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('Admin::contacts.index') }}" class="btn btn-default">@lang('admin.Cancel')</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
