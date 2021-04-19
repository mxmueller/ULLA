@extends('layouts.app')

@section('content')

<div class="row justify-content-left">
    <div class="w-25 p-3 mt-2">
        <div class="card rounded-0 custom-border-default">
            <div class="card-body h4 mt-2">
                <div>{{ __('Herzlich willkommen') }}</div>
                <div class="font-weight-bold">{{ Auth::user()->name }}</div>
            </div>
        </div>
    </div>

    <div class="w-25 p-3 mt-2">
        <div class="card rounded-0 custom-border-default">
            <div class="card-body h4 mt-2">
                <div>{{ __('Benutzergruppe:') }}</div>
                <div class="font-weight-bold">{{ Auth::user()->roles->first()->name }}</div>
            </div>
        </div>
    </div>
</div>

@endsection