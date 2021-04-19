@component('mail::message')
# Hallo, {{$recipient}}!

Dein Urlaubsantrag mit der Id: #{{$requestId}} wurde eingereicht.

@component('mail::button', ['url' => $detailLink])
Antrag ansehen 📩
@endcomponent

Der von dir ausgewählte Vorgesetzte wurde informiert.
@endcomponent