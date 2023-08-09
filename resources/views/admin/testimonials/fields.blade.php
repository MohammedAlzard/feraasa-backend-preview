<!-- image Field -->
<div class="form-group col-md-12">
    {!! Form::label('image', trans('admin.image').':') !!}
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
</div>

<!-- Name Field EN -->
<div class="form-group col-md-6">
    {!! Form::label('name', trans('admin.Name').': ('.trans('admin.English') .')') !!}
    {!! Form::text('en[name]', $testimonial->translate('en')->name, ['class' => 'form-control']) !!}
</div>
<!-- Name Field AR -->
<div class="form-group col-md-6">
    {!! Form::label('name', trans('admin.Name').': ('.trans('admin.Arabic') .')') !!}
    {!! Form::text('ar[name]', $testimonial->translate('ar')->name, ['class' => 'form-control']) !!}
</div>

<!-- Job Field EN -->
<div class="form-group col-md-6">
    {!! Form::label('job', trans('admin.Job').': ('.trans('admin.English') .')') !!}
    {!! Form::text('en[job]', $testimonial->translate('en')->job, ['class' => 'form-control']) !!}
</div>
<!-- Job Field AR -->
<div class="form-group col-md-6">
    {!! Form::label('job', trans('admin.Job').': ('.trans('admin.Arabic') .')') !!}
    {!! Form::text('ar[job]', $testimonial->translate('ar')->job, ['class' => 'form-control']) !!}
</div>

<!-- Description Field EN -->
<div class="form-group col-md-6">
    {!! Form::label('description', trans('admin.Description').': ('.trans('admin.English') .')') !!}
    {!! Form::textarea('en[description]', $testimonial->translate('en')->description, ['class' => 'form-control']) !!}
</div>
<!-- Description Field AR -->
<div class="form-group col-md-6">
    {!! Form::label('description', trans('admin.Description').': ('.trans('admin.Arabic') .')') !!}
    {!! Form::textarea('ar[description]', $testimonial->translate('ar')->description, ['class' => 'form-control']) !!}
</div>

<!-- Order By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_by', trans('admin.Order_By').':') !!}
    {!! Form::number('order_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-3">
    {!! Form::label('is_active', trans('admin.Is_Active').':') !!}
    {!! Form::select('is_active', [1 => trans('admin.Yes'), 0 => trans('admin.No')], null, ['class' => 'form-control']) !!}
</div>
