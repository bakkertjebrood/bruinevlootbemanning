@component('mail::message')
# Hallo,

Klik op de onderstaande knop om uw account op BruineVlootBemanning.nl te activeren.

@component('mail::button', ['url' => url('register/verify/').'/'.$user->email_token])
Activeer account
@endcomponent

Tot ziens,<br>
{{ config('app.name') }}
@endcomponent
