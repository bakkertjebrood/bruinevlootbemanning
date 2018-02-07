@component('mail::message')
# @lang('labels.hi'),

@lang('labels.newmessage')<br>

Naam:       {{$formdata['name']}}<br>
E-mail:     {{$formdata['email']}}<br>
Onderwerp:  {{$formdata['subject']}}<br><br>
Bericht:<br>
{{$formdata['description']}}<br>

@lang('labels.goodbye'),<br>
{{ config('app.name') }}
@endcomponent
