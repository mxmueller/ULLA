@component('mail::message')
# Hallo, {{$executive}}!

Ihnen wurde ein neuer Antrag zugewiesen!

@component('mail::table')
| Antragsteller:in  | Id:             |
| :---------------- | :------------- |
| {{$creator}}      | #{{$requestId}} |
@endcomponent

@component('mail::button', ['url' => $link])
Zum Antrag 📄
@endcomponent

@endcomponent