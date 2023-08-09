<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', trans('admin.Code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191, 'required'=>true]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('admin.Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191, 'required'=>true]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', trans('admin.Description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>4]) !!}
</div>

{{--<!-- Uses Field -->
<div class="form-group col-sm-4">
    {!! Form::label('uses', 'trans('admin.Uses):') !!}
    {!! Form::number('uses', null, ['class' => 'form-control']) !!}
</div>--}}

<!-- Max Uses Field -->
<div class="form-group col-sm-4">
    {!! Form::label('max_uses', trans('admin.Max_Uses').':') !!}
    {!! Form::number('max_uses', null, ['class' => 'form-control', 'min'=>1, 'required'=>true]) !!}
</div>

{{--<!-- Max Uses User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_uses_user', 'Matrans('admin.max_uses_user).:') !!}
    {!! Form::number('max_uses_user', null, ['class' => 'form-control']) !!}
</div>--}}

{{--
<!-- Type Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('type', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('type', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('type', 'Type', ['class' => 'form-check-label']) !!}
    </div>
</div>
--}}


<!-- Discount Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('discount_amount', trans('admin.Discount_Amount').' %:') !!}
    {!! Form::number('discount_amount', null, ['class' => 'form-control', 'min'=>1, 'max'=>100, 'required'=>true]) !!}
</div>

{{--<!-- Is Fixed Field -->
<div class="form-group col-sm-4">
    {!! Form::label('is_fixed', 'trans('admin.Is_Fixed). :') !!}
    {!! Form::select('is_fixed', [1 => trans('admin.Yes'), 0 => trans('admin.No')], null, ['class' => 'form-control']) !!}
</div>--}}



<!-- Starts At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starts_at', trans('admin.Starts_At').':') !!}
    {{--{!! Form::datetime('starts_at', null, ['class' => 'form-control','id'=>'starts_at', 'required'=>true]) !!}--}}
    @if(isset($coupon))
        {!! Form::input('dateTime-local', 'starts_at', $coupon->starts_at, ['class' => 'form-control','id'=>'starts_at', 'required'=>true]) !!}
    @else
        {!! Form::input('dateTime-local', 'starts_at', Carbon\Carbon::now(), ['class' => 'form-control','id'=>'starts_at', 'required'=>true]) !!}
    @endif
</div>

@push('page_scripts')
    <script type="text/javascript">
        /*function minusHours(numOfHours, date = new Date()) {
            date.setTime(date.getTime() - numOfHours * 60 * 60 * 1000);

            return date;
        }*/

        /*$('#starts_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })*/
        var today = new Date().toISOString().slice(0, 17); // old = 16
        // var today = minusHours(2).toISOString().slice(0, 17); // old = 16
        // console.log(today);
        document.getElementsByName("starts_at")[0].min = today;
    </script>
@endpush

<!-- Expires At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expires_at', trans('admin.Expires_At').':') !!}
    {{--{!! Form::datetime('expires_at', null, ['class' => 'form-control','id'=>'expires_at', 'required'=>true]) !!}
    <input type="datetime-local" id="expires_at" class="form-control" name="expires_at" required />--}}
    {!! Form::input('dateTime-local', 'expires_at', null, ['class' => 'form-control','id'=>'expires_at', 'required'=>true]) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        var today2 = new Date().toISOString().slice(0, 16);
        document.getElementById("expires_at").min = today2;
    </script>
@endpush
