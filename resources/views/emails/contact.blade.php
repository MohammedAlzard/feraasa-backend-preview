@component('mail::message')
# {!! __('site.New_Message_from') !!}: ({!! $data['name'] !!}),

## {!! __('site.Message') !!}:
{!! $data['message'] !!}

@component('mail::button', ['url' => url('/admin/contacts/'.$data['id'])])
    {!! __('site.View_Details') !!}
@endcomponent

{!! __('site.Thanks') !!},<br>
{{ config('app.name') }}
@endcomponent
