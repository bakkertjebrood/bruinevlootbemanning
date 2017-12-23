@component('mail::message')
# Hallo {{Auth::user()->firstname}},

Bevestig a.u.b. uw e-mail adres op BruineVlootBemanning.nl door op de onderstaande knop te klikken.

@component('mail::button', ['url' => 'BruineVlootBemanning.nl'])
Ga naar BruineVlootBemanning.nl
@endcomponent

Tot ziens,<br>
{{ config('app.name') }}
@endcomponent
