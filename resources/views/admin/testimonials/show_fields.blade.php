<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', trans('admin.Image').':') !!}
    <p>
        <img src="{{ $testimonial->image }}" width="200">
    </p>
</div>

<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', trans('admin.Name').': ('.trans('admin.English') .')') !!}
    <p>{!! $testimonial->translate('en')->name !!}</p>
</div>
<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', trans('admin.Name').': ('.trans('admin.Arabic') .')') !!}
    <p>{!! $testimonial->translate('ar')->name !!}</p>
</div>

<!-- Job Field -->
<div class="col-sm-6">
    {!! Form::label('name', trans('admin.Job').': ('.trans('admin.English') .')') !!}
    <p>{!! $testimonial->translate('en')->job !!}</p>
</div>
<!-- Job Field -->
<div class="col-sm-6">
    {!! Form::label('name', trans('admin.Job').': ('.trans('admin.Arabic') .')') !!}
    <p>{!! $testimonial->translate('ar')->job !!}</p>
</div>

<!-- Description Field -->
<div class="col-sm-6">
    {!! Form::label('description', trans('admin.Description').': ('.trans('admin.English') .')') !!}
    <p>{!! $testimonial->translate('en')->description !!}</p>
</div>
<!-- Description Field -->
<div class="col-sm-6">
    {!! Form::label('description', trans('admin.Description').': ('.trans('admin.Arabic') .')') !!}
    <p>{!! $testimonial->translate('ar')->description !!}</p>
</div>

<!-- Is Active Field -->
<div class="col-sm-6">
    {!! Form::label('is_active', trans('admin.Is_Active').':') !!}
    <p>{{ \App\Helpers\HelpersFun::isTrue($testimonial->is_active) }}</p>
</div>

<!-- Order By Field -->
<div class="col-sm-6">
    {!! Form::label('order_by', trans('admin.Order_By').':') !!}
    <p>{{ $testimonial->order_by }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', trans('admin.Created_At').':') !!}
    <p>{{ $testimonial->created_at->toDayDateTimeString() }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', trans('admin.Updated_At').':') !!}
    <p>{{ $testimonial->updated_at->toDayDateTimeString() }}</p>
</div>
