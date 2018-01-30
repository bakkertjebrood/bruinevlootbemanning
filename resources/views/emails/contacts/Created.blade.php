@component('mail::message')
# @lang('labels.hi'),

@lang('labels.newmessage')

@component('mail::button', ['url' => url('user/responses')])
@lang('labels.gotosite')
@endcomponent

@lang('labels.goodbye'),<br>
{{ config('app.name') }}
@endcomponent
