@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 mt-5">
            <div class="jumbotron rounded-0">
                <h3 class="display-4">Alle Anträge:</h2>
                    <p>Ausgabe aller segmentierter Anträge.</p>
                    <hr class="my-4">
                    <p>Segmentierung:</p>
                    <form>
                        <div class="form-row align-items-center">
                            <div class="p-2 border border-3 rounded-1  bg-light col-auto my-1 mr-1">
                                <label class="mr-sm-2" for="order">Zeit:</label>
                                <select class="custom-select mr-sm-2" id="order">
                                    <option value="desc" selected>Anzeige:</option>
                                    <option value="asc">Aufsteigend</option>
                                    <option value="desc">Absteigend</option>
                                </select>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>

                            <div class="p-2 border border-1 bg-light rounded-1 ml-1 col-auto my-1 mr-1">
                                <label class="mr-sm-2" for="employees">Mitarbeiter/inn:</label>
                                <select class="custom-select mr-sm-2" id="employees">
                                    <option value="none" selected>Auswählen:</option>
                                    <option value="none">Alle</option>
                                    @foreach ($userCollection as $user)
                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>

                            <div class="p-2 border border-1 bg-light rounded-2 ml-1 mr-1 col-auto my-1">
                                <label class="mr-sm-2" for="quantum">Anzahl:</label>
                                <select class="custom-select mr-sm-2" id="quantum">
                                    <option value="all" selected>Auswählen:</option>
                                    <option value="all">Alle</option>
                                    <option value="5">5</option>
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>

                            <div class="p-2 border border-1 bg-light rounded-2 ml-1 col-auto my-1">
                                <label class="mr-sm-2" for="status">Status:</label>
                                <select class="custom-select mr-sm-2" id="status">
                                    <option value="any" selected>Auswählen:</option>
                                    <option value="any">Alle</option>
                                    <option value="rejected">Abgelehnt</option>
                                    <option value="granted">Genehmigt</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="col-auto pl-0 mt-3">
                        <button type="submit" id="request-search" class="btn btn-primary">Laden</button>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection