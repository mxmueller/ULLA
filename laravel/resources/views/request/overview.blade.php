@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 mt-5">

            <div class="jumbotron rounded-0">
                <h3 class="display-4">Übersicht:</h2>
                    <hr class="my-4">
            </div>

        </div>


        <div class="custom-border-default w-100 mt-3 mb-5">
            <table class="table table-hover mb-0">
                <thead class="border-top-0" style="
                    border-top: hidden !important;
                ">
                    <tr>
                        <td class="font-weight-bold" scope="col">id:</td>
                        <td class="font-weight-bold" scope="col">Datum:</td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col">Anmerkung:</td>
                        <td class="font-weight-bold" scope="col">Status:</td>
                        <td class="font-weight-bold" scope="col"></td>
                        <td class="font-weight-bold" scope="col">Aktion:</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requestOverviewArray as $requestOverviewItem)
                    <tr>
                        <th scope="row" class="text-danger">#{{$requestOverviewItem['arguments']['id']}}</th>
                        @if ($requestOverviewItem['arguments']['halfday'] == 1)
                        <td>{{$requestOverviewItem['timestamps']['start']}}</td>
                        <td>bis</td>
                        <td>{{$requestOverviewItem['timestamps']['end']}}</td>
                        <td>Halbtags</td>
                        @else
                        <td>{{$requestOverviewItem['timestamps']['start']}}</td>
                        <td>bis</td>
                        <td>{{$requestOverviewItem['timestamps']['end']}}</td>
                        <td>-</td>
                        @endif
                        <td>{{$requestOverviewItem['status']['message']}}</td>
                        <td>{!! $requestOverviewItem['status']['svg'] !!}</td>
                        <td>
                            <a href="/request/{{$requestOverviewItem['arguments']['id']}}/detail" class="btn btn-outline-secondary btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection