@component('mail::message')
# Hallo, {{$creator}}!

Dein Urlaubsantrag mit der Id: #{{$requestId}} wurde genehmigt.

@component('mail::button', ['url' => $link])
Antrag ansehen 📩
@endcomponent

Der Urlaub kann in deinen Kalendern vermerkt werden:
@component('mail::button', ['url' => $ics, 'color' => 'red'])
Outlook
@endcomponent

@component('mail::button', ['url' => $google, 'color' => 'red'])
Google
@endcomponent

@endcomponent