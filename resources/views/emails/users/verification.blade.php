@component('mail::message')
# Hallo,

Klik op de onderstaande knop om uw account op BruineVlootBemanning.nl te registreren.

@component('mail::button', ['url' => url('register/verify/').'/'.$user->email_token])
Activeer account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
