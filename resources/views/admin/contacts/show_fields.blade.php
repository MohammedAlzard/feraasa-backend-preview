<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', trans('admin.Name').':') !!}
    <p>{{ $contact->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', trans('admin.Email').':') !!}
    <p>{{ $contact->email }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', trans('admin.Subject').':') !!}
    <p>{{ $contact->subject }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', trans('admin.Message').':') !!}
    <p>{{ $contact->message }}</p>
</div>

<!-- Is Read Field -->
<div class="col-sm-12">
    {!! Form::label('is_read', trans('admin.Is_Read').':') !!}
    <p>{{ \App\Helpers\HelpersFun::isTrue($contact->is_read) }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', trans('admin.Created_At').':') !!}
    <p>{{ $contact->created_at->toDayDateTimeString() }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', trans('admin.Updated_At').':') !!}
    <p>{{ $contact->updated_at->toDayDateTimeString() }}</p>
</div>


