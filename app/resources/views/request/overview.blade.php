@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="custom-border-default w-100 mt-5">

            <table class="table table-hover">
                <thead class="border-top-0">
                    <tr>
                        <th scope="col">id:</th>
                        <th scope="col">Datum:</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Anmerkung:</th>
                        <th scope="col">Status:</th>
                        <th scope="col"></th>
                        <th scope="col">Aktion:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requestOverviewArray as $requestOverviewItem)
                    <tr>
                        <th scope="row">#{{$requestOverviewItem['arguments']['id']}}</th>
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
                            <a href="/request/{{$requestOverviewItem['arguments']['id']}}/detail" class="btn btn-link btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection