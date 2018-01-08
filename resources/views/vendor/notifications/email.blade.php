@component('mail::message')
# Hallo,

Klik op de onderstaande knop om uw wachtwoord op BruineVlootBemanning.nl te herstellen.

@component('mail::button', ['url' => $actionUrl])
Herstel wachtwoord
@endcomponent

Tot ziens,<br>
{{ config('app.name') }}
@endcomponent
