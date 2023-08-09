<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('admin.Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', trans('admin.Email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', trans('admin.Subject').':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', trans('admin.Message').':') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Read Field -->
<div class="form-group col-sm-3">
    {!! Form::label('is_read', trans('admin.Is_Read').':') !!}
    {!! Form::select('is_read', [1 => trans('admin.Yes'), 0 => trans('admin.No')], null, ['class' => 'form-control']) !!}
</div>

