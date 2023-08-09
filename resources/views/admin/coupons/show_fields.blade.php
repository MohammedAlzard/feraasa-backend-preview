<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', trans('admin.Code').':') !!}
    <p>{{ $coupon->code }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', trans('admin.Name').':') !!}
    <p>{{ $coupon->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', trans('admin.Description').':') !!}
    <p>{{ $coupon->description }}</p>
</div>

<!-- Uses Field -->
<div class="col-sm-12">
    {!! Form::label('uses', trans('admin.Uses').':') !!}
    <p>{{ $coupon->uses }}</p>
</div>

<!-- Max Uses Field -->
<div class="col-sm-12">
    {!! Form::label('max_uses', trans('admin.Max_Uses').':') !!}
    <p>{{ $coupon->max_uses }}</p>
</div>

<!-- Max Uses User Field -->
{{--<div class="col-sm-12">
    {!! Form::label('max_uses_user', trans('admin.Max_Uses_User').':') !!}
    <p>{{ $coupon->max_uses_user }}</p>
</div>--}}

<!-- Type Field -->
{{--<div class="col-sm-12">
    {!! Form::label('type', trans('admin.Type').':') !!}
    <p>{{ $coupon->type }}</p>
</div>--}}

<!-- Discount Amount Field -->
<div class="col-sm-12">
    {!! Form::label('discount_amount', trans('admin.Discount_Amount').':') !!}
    <p>{{ $coupon->discount_amount }}</p>
</div>

<!-- Is Fixed Field -->
<div class="col-sm-12">
    {!! Form::label('is_fixed', trans('admin.Is_Fixed').':') !!}
    <p>{{ \App\Helpers\HelpersFun::isTrue($coupon->is_fixed) }}</p>
</div>

<!-- Starts At Field -->
<div class="col-sm-12">
    {!! Form::label('starts_at', trans('admin.Starts_At').':') !!}
    <p>{{ $coupon->starts_at->toDayDateTimeString() }}</p>
</div>

<!-- Expires At Field -->
<div class="col-sm-12">
    {!! Form::label('expires_at', trans('admin.Expires_At').':') !!}
    <p>{{ $coupon->expires_at->toDayDateTimeString() }}</p>
</div>

