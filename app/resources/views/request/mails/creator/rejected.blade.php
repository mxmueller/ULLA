@component('mail::message')
# Hallo, {{$creator}}!

Dein Urlaubsantrag mit der Id: #{{$requestId}} wurde abgelehnt.

@component('mail::button', ['url' => $link])
Antrag ansehen 📩
@endcomponent

@endcomponent