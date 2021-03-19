@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($details as $detail)

        @if ($detail['responseError'] == true)
        <div class="alert alert-danger w-50 mt-5" role="alert">
            {{$detail['responseErrorMessage']}}
        </div>
        @else
        <div class="w-100 mt-5">

            <form id="executive-decision-form" method="post" action="{{ url('request_decision_submit') }}">@csrf</form>

            <input form="executive-decision-form" type="hidden" name="id" value={{$detail['request']['id']}}></input>

            <div class="jumbotron rounded-0">
                <h2 class="display-4">Antrag
                    <span class="badge rounded-pill bg-secondary text-white">#{{$detail['request']['id']}}</span>
                </h2>
                <p class="lead">Auswahl treffen ob der unten aufgeführte Antrag genehmigt oder abgelehnt werden soll.</p>
                <hr class="my-4">

                <p>Auswählen:</p>
                <!-- checkbox -->
                <div class="form-check form-check-inline">
                    <input form="executive-decision-form" class="form-check-input" type="radio" name="radio" id="granted_radio" value="granted">
                    <label class="font-weight-bold form-check-label text-success" for="granted_radio">Genehmigen</label>
                </div>
                <div class="form-check form-check-inline">
                    <input form="executive-decision-form" class="form-check-input" type="radio" name="radio" id="rejectedRadio" value="rejected">
                    <label class="font-weight-bold form-check-label text-danger" for="rejectedRadio">Ablehnen</label>
                </div>
                <br>
                <!-- Textfield -->
                <label class="mt-3" for="decisionComment">Kommentar: (Optional)</label>
                <textarea form="executive-decision-form" name="comment" maxlength="250" class="rounded-0 form-control" id="decsisionComment" rows="4"></textarea>
                <small class="form-text text-muted">Maximal 250 Zeichen</small>

                <br>
                <button form="executive-decision-form" type="submit" class="btn btn-outline-secondary">Bestätigen</button>
            </div>

        </div>

        <div class="custom-border-default w-100 mt-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item pt-5 pb-5">
                    <h2 class="display-4 mb-3 pb-1">Details:
                    </h2>

                    <p class="text-secondary">Allgemein:</p>
                    <table class="table caption-top">
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Ersteller:</td>
                            <td>{{$detail['request']['creator']}}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Zugewiesen:</td>
                            <td>{{$detail['request']['assigned']}}</td>
                        </tr>
                    </table>

                    <p class="text-secondary">Zeitraum:</p>
                    <table class="table caption-top">
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Von:</td>
                            <td>{{$detail['request']['timestamps']['start']}}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Bis:</td>
                            <td>{{$detail['request']['timestamps']['end']}}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Gesamt:</td>
                            <td>{{$detail['request']['sum']}} Tage</td>
                        </tr>

                    </table>

                    <p class="text-secondary">Sonstiges:</p>
                    <table class="table caption-top">
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Antragstyp:</td>
                            <td>{{$detail['request']['type']}}</td>
                        </tr>

                        @if ($detail['request']['halfday'] == 1)
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">Anmerkungen:</td>
                            <td>Halber Tag</td>
                        </tr>
                        @endif
                    </table>

                    <p class="text-secondary">Vertretung(en) u. übergabe Datum:</p>
                    <table class="table">
                        @foreach ($detail['request']['stand_ins'][0] as $stand_in)
                        <tr>
                            <td style="width: 25%" class="font-weight-bold" scope="row">{{$stand_in['user_name']}}</td>
                            <td>{{$stand_in['timestamps']['overhanding']}}</td>
                        </tr>
                        @endforeach
                    </table>
                </li>
            </ul>
        </div>

        <div class="w-100 mt-5">

            <div class="jumbotron rounded-0">
                <h3 class="display-4">Kommentar(e)</h2>
                    <hr class="my-4">
                    @if ($detail['request']['comments']['initial']['available'] == true)
                    <div class="bg-light p-3 rounded-lg mt-3 mb-3">
                        <p class="lead font-weight-bold">{{$detail['request']['creator']}}</p>
                        <p>{{$detail['request']['comments']['initial']['comment']}}</p>
                    </div>
                    @endif

                    @if ($detail['request']['comments']['granted']['available'] == true)
                    <div class="bg-light p-3 rounded-lg mt-3 mb-3">
                        <p class="lead font-weight-bold">{{$detail['request']['assigned']}}</p>
                        <p>{{$detail['request']['comments']['granted']['comment']}}</p>
                    </div>
                    @endif

                    @if ($detail['request']['comments']['rejected']['available'] == true)
                    <div class="bg-light p-3 rounded-lg mt-3 mb-3">
                        <p class="lead font-weight-bold">{{$detail['request']['assigned']}}</p>
                        <p>{{$detail['request']['comments']['rejected']['comment']}}</p>
                    </div>
                    @endif

                    @if (
                    $detail['request']['comments']['granted']['available'] == false &&
                    $detail['request']['comments']['rejected']['available'] == false &&
                    $detail['request']['comments']['initial']['available'] == false
                    )
                    <div class="">
                        <p>Keine Kommentar vorhanden</p>
                    </div>
                    @endif
            </div>

        </div>

        <div class="custom-border-default w-100 mt-3">
        </div>
        @endif

        @endforeach
    </div>
</div>
@endsection