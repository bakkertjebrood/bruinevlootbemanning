@component('mail::message')
# @lang('labels.hi'),

@lang('labels.clicktoactivate')

@component('mail::button', ['url' => url('register/verify/').'/'.$user->email_token])
@lang('labels.activateaccount')
@endcomponent

@lang('labels.goodbye'),<br>
{{ config('app.name') }}
@endcomponent
