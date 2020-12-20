@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 p-3">
            <div class="card rounded-0 custom-border-default mt-5">

                <div class="card-header">{{ __('Urlaubsantrag erstellen & zuweisen') }}</div>

                <div class="card-body">

                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Antragsteller</label>
                            <input class="form-control" type="text" placeholder="{{ Auth::user()->name }}" readonly>
                            <small id="emailHelp" class="form-text text-muted">Kann nicht bearbeitet werden.</small>
                        </div>

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
                                    <small class="form-text text-muted">Es können beliebig viele Vertretung hinzugefügt
                                        werden.</small>
                                </div>



                            </div>

                        </div>

                        <div class="form-group">
                            <label for="request_comment">Antrags Kommentar (Optional)</label>
                            <textarea class="form-control" id="request_comment" rows="4"></textarea>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Halber Tag</label>
                        </div>



                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
