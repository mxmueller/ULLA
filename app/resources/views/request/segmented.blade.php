@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 mt-5">

            <div class="jumbotron rounded-0 p-0">
                <div class="jumbotron rounded-0">
                    <h2 class="display-4">Gefundene Anträge
                        <span class="badge rounded-pill bg-secondary text-white">{{$segmented['entrys']}}</span>
                    </h2>
                    <hr class="my-4">
                    <p>
                        Die gefundenen Einträge können in der Detailansicht mit allen Einzelheiten eingesehen werden:
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                        </svg>
                    </p>
                    <a href="/request/summary" class="btn btn-primary text-light" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Zurück
                    </a>
                </div>
            </div>

        </div>

        @if ($segmented['entrys'] == 0)

        <div class="alert alert-danger w-100" role="alert">
            Die von Ihnen geforderte Anfrage hat leider keine Ergebnisse liefern können.
        </div>

        @else

        <div class="custom-border-default w-100 mt-3 mb-5">
            <table class="table table-hover mb-0">
                <thead class="border-top-0" style="
                    border-top: hidden !important;
                ">
                    <tr>
                        <td class="font-weight-bold" scope="col">id:</td>
                        <td class="font-weight-bold" scope="col">Antragsteller/in:</td>
                        <td class="font-weight-bold" scope="col">Zugewiesen an:</td>
                        <td class="font-weight-bold" scope="col">Eingereicht am:</td>
                        <td class="font-weight-bold" scope="col">Status:</td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col">Aktion:</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($segmented['sq'] as $request)

                    <tr>
                        <th scope="row" class="text-danger">#{{$request['id']}}</th>
                        <td>{{$request['creator']}}</td>
                        <td>{{$request['executive']}}</td>
                        <td>{{$request['created']}}</td>
                        <td>{!!$request['status']['svg']!!}</td>
                        <td>{{$request['status']['message']}}</td>
                        <td>
                            <a href="/request/{{$request['id']}}/detail" class="btn btn-outline-secondary btn-sm">Detail</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        @endif
    </div>
</div>
@endsection