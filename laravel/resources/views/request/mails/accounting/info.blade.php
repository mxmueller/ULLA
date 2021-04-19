@component('mail::message')
# Hallo, {{$accounting}}!

Der von {{$creator}} erstellte Antrag mit der Id: #{{$requestId}} wurde von {{$executive}} genehmigt.

@component('mail::button', ['url' => $link])
Antrag im Detail ansehen 📩
@endcomponent

@component('mail::button', ['url' => $searchQuery])
Übersicht aller Anträge des Antragstellers 📦
@endcomponent

@endcomponent