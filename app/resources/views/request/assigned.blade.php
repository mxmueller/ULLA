@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if ($assigned['assignedError'] == true)

        <div class="mt-5 alert alert-danger" role="alert">
            {{$assigned['assignedErrorMessage']}}
        </div>

        @else

        <div class="w-100 mt-5">
            <div class="jumbotron rounded-0">
                <h3 class="display-4">Zugewiesen:</h2>
                    <hr class="my-4">
                    <p>Zugewiesen Anträge die noch nicht bearbeitet (freigegeben/abgelehnt) wurden werden unter ausstehend gelistet.</p>
                    <p>Ist ein Antrag einmal bearbeitet kann dieser nicht mehr geändert werden</p>

            </div>
        </div>

        <div id="pending" class="custom-border-default w-100 mt-3">

            <div class="row">
                <div class="col">
                    <h1 class="p-3 text-muted">Ausstehend:</h1>
                </div>
            </div>


            <table class="table table-hover mb-0">
                <thead class="border-top-0" style="
                    border-top: hidden !important;
                ">
                    <tr>
                        <td class="font-weight-bold" scope="col">id:</td>
                        <td class="font-weight-bold" scope="col">Datum:</td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col">Antragsteller/inn:</td>
                        <td class="font-weight-bold" scope="col">Status:</td>
                        <td class="font-weight-bold" scope="col">Aktion:</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assigned['assigned'] as $entry)



                    @if ($entry['arguments']['pending'] == true)

                    <tr class="entry">
                        <th scope="row" class="text-danger">#{{$entry['arguments']['id']}}</th>
                        <td>{{$entry['timestamps']['start']}}</td>
                        <td>bis</td>
                        <td>{{$entry['timestamps']['end']}}</td>
                        <td>{{$entry['creator']}}</td>
                        <td>{!!$entry['status']['svg']!!}</td>
                        <td>
                            <a href="/request/{{$entry['arguments']['id']}}/decision" class="btn btn-outline-secondary btn-sm">Entscheiden</a>
                        </td>
                    </tr>

                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>


        <div id="edited" class="custom-border-default w-100 mt-5 mb-5">

            <div class="row">
                <div class="col">
                    <h1 class="p-3 text-muted">Bearbeitet:</h1>
                </div>
            </div>

            <table class="table table-hover mb-0">
                <thead class="border-top-0" style="
                    border-top: hidden !important;
                ">
                    <tr>
                        <td class="font-weight-bold" scope="col">id:</td>
                        <td class="font-weight-bold" scope="col">Datum:</td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col">Antragsteller/inn:</td>
                        <td class="font-weight-bold" scope="col">Status:</td>
                        <td class="font-weight-bold" scope="col">Aktion:</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assigned['assigned'] as $entry)

                    @if ($entry['arguments']['pending'] == false)

                    <tr class="entry">
                        <th scope="row" class="text-danger">#{{$entry['arguments']['id']}}</th>
                        <td>{{$entry['timestamps']['start']}}</td>
                        <td>bis</td>
                        <td>{{$entry['timestamps']['end']}}</td>
                        <td>{{$entry['creator']}}</td>
                        <td>{!!$entry['status']['svg']!!}</td>
                        <td>
                            <a href="/request/{{$entry['arguments']['id']}}/detail" class="btn btn-outline-secondary btn-sm">Einsehen</a>
                        </td>
                    </tr>

                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>

    <script>
        $(function() {
            if ($('#pending').find('.entry').length == 0) {
                $('#pending').hide();
            };
            if ($('#edited').find('.entry').length == 0) {
                $('#edited').hide();
            };
        })
    </script>

</div>
@endsection