@component('mail::message')
# Hallo,

U heeft een nieuw bericht ontvangen op BruineVlootBemanning.nl

@component('mail::button', ['url' => url('user/responses')])
Ga naar BruineVlootBemanning.nl
@endcomponent

Tot ziens,<br>
{{ config('app.name') }}
@endcomponent
