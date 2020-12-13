@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 p-3">
            <div class="card shadow">

                <div class="card-header">{{ __('Urlaubsantrag erstellen & zuweisen') }}</div>

                <div class="card-body">

                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Folgendem Mitarbeiter soll der Antrag zur Freigabe
                                zugewiesen werden:</label>

                            <select class="form-control form-control">
                                <option>Hans Zimmer</option>
                                <option>Iron Man</option>
                                <option>Elon Musk</option>
                                <option>Mark Zuckerberg</option>
                                <option>Max Mustermann</option>
                            </select>

                        </div>

                        <div class="form-group">


                                <div class="form-group">

                                <div class="stand-in first">
                                    <label for="exampleFormControlSelect2">Vertretung hinzufügen:
                                        </label>

                                    <select class="form-control form-control">
                                        <option>Hans Zimmer</option>
                                        <option>Iron Man</option>
                                        <option>Elon Musk</option>
                                        <option>Mark Zuckerberg</option>
                                        <option>Max Mustermann</option>
                                    </select>
                                </div>

                                <div class="stand-in extension mt-1 w-75 ">
                                    <select class="form-control form-control">
                                        <option>Hans Zimmer</option>
                                        <option>Iron Man</option>
                                        <option>Elon Musk</option>
                                        <option>Mark Zuckerberg</option>
                                        <option>Max Mustermann</option>
                                    </select>

                                  <button type="button" class="btn btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg>
                                    </button>
                                </div>

                                </div>
                                <div class="col text-center">
                                <button type="button" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    Weitere Vertretung hinzufügen
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="request_comment">Antrags Kommentar (Optional)</label>
                            <textarea class="form-control" id="request_comment" rows="4"></textarea>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
