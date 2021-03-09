@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 p-3">

            @foreach ($collection as $entry)
            {{($entry[1]['request'])}}
            @endforeach

        </div>
    </div>
</div>
@endsection