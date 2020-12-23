@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 p-3">
            <div id="request-interface-form" class="card rounded-0 custom-border-default mt-5">

                <div class="card-header">{{ __('Urlaubsantrag erstellen & zuweisen') }}</div>

                <div class="card-body">
                    <form id="backend-valdiation-request">
                        @csrf
                        <div class="form-check w-25 mt-2">
                            <input type="checkbox" id="toggle-date" class="rounded-0 form-check-input"
                                id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Halber Tag</label>
                        </div>

                        <div class="form-group w-25 mt-2" id="day-input">
                            <label for="request_comment">Datum festlegen: (Tag wählen)</label>
                            <input id="half-day" readonly="readonly" class="rounded-0 date-range-picker form-control"
                                name="daterange" type="text">
                        </div>


                        <div class="form-group w-25 mt-2" id="range-input">
                            <label for="request_comment">Datum festlegen: (Zeitraum wählen)</label>
                            <input id="range" readonly="readonly" class="rounded-0 date-range-picker form-control"
                                name="daterange" type="text">
                        </div>

                        <div class="form-group w-50">
                            <label for="exampleInputEmail1">Antragsteller</label>
                            <input id="applicant" value="{{ Auth::user()->name }}" user_id="{{ Auth::user()->id }}" class="rounded-0 form-control" type="text" placeholder="{{ Auth::user()->name }}"
                                readonly>
                            <small id="emailHelp" class="form-text text-muted">Kann nicht bearbeitet werden.</small>
                        </div>

                        <div class="form-group mt-4 w-50">
                            <label for="exampleFormControlSelect2">Folgendem Mitarbeiter soll der Antrag zur Freigabe
                                zugewiesen werden:</label>
                            <select id="executive" class="rounded-0 form-control form-control">
                                @foreach($executives as $executive)
                                <option value="{{ $executive->id }}">{{ $executive->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-4">
                            <div class="form-group">
                                <div class="stand-in first">


                                    <div class="first-stand-in input-group row">

                                        <div class="col-3">
                                            <label class="float-left">Vertretung(en) hinzufügen:
                                            </label>
                                            <select class="rounded-0 first-stand-in form-control form-control">
                                                @foreach($stand_ins as $stand_in)
                                                <option value="{{ $stand_in->id }}">{{ $stand_in->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="float-left">Übergabe Datum:
                                            </label>
                                            <input id="first-stand-in" readonly="readonly"
                                                class=" rounded-0 date-range-picker form-control" name="daterange"
                                                type="text">
                                        </div>
                                    </div>

                                    <div class="add-on d-none input-group mt-2 row float-left">


                                        <div class="col-3 float-left">
                                            <select class="rounded-0 form-control form-control">
                                                @foreach($stand_ins as $stand_in)
                                                <option value="{{ $stand_in->id }}">{{ $stand_in->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-3 float-left">
                                            <input readonly="readonly" class=" rounded-0 date-range-picker form-control"
                                                name="daterange" type="text">
                                        </div>

                                        <div class="col-4 float-left">
                                            <button class="delete-add-on btn btn-outline-secondary rounded-0"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                                &nbsp; Löschen
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row w-100 ml-0 mt-2">
                                    <small class="form-text text-muted">Es können beliebig viele Vertretung hinzugefügt
                                        werden.</small>
                                </div>

                                <div class="row w-100 ml-0">
                                    <button type="button" class="rounded-0 add-stand-in btn btn-outline-secondary mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                        Weitere Vertretung hinzufügen
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label for="request_comment">Antrags Kommentar: (Optional)</label>
                            <textarea class="rounded-0 form-control" id="request_comment" rows="4"></textarea>
                        </div>

                        <button type="button" id="form-submit" class="btn btn-primary rounded-0">Antrag Abschicken</button>
                        <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
