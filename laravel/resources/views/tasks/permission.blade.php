@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 p-3">


            <div class="card rounded-0 custom-border-default">
                <div class="card-header font-weight-bold">{{ __('Benutzer Manager') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success " role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach($users as $user)
                    <form id="role_change--{{$user->id}}" method="post" action="{{ url('change_user_role') }}">@csrf
                    </form>
                    <form id="delete_user--{{$user->id}}" method="post" action="{{ url('delete_user') }}">@csrf</form>
                    @endforeach

                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Rolle (Aktuell)</th>
                            <th>Rolle (Neu)</th>
                            <th>Funktionen</th>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}
                                    <input form="role_change--{{$user->id}}" type="hidden" name="user_id"
                                        value="{{$user->id}}" />
                                    <input form="delete_user--{{$user->id}}" type="hidden" name="user_id"
                                        value="{{$user->id}}" />
                                </td>
                                <td>{{$user->name}} </td>
                                <td>{{$user->email}} </td>
                                <td>{{$user->roles[0]->name}} </td>
                                <td>
                                    <select form="role_change--{{$user->id}}" id="new_user_role" class="form-control"
                                        name="new_user_role">
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button form="role_change--{{$user->id}}" type="submit" class="btn btn-success">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
                                        </svg>
                                    </button>

                                    <button form="delete_user--{{$user->id}}" type="submit" class="btn btn-danger">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bucket"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0h8.945a4.5 4.5 0 0 0-8.945 0zm9.892 1H2.581l1.286 8.574A.5.5 0 0 0 4.36 15h7.278a.5.5 0 0 0 .494-.426L13.42 6z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card rounded-0 custom-border-default mt-5">
                <div class="card-header font-weight-bold">{{ __('Verfügbare Rollen') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Rolle</th>
                            <th>Definition</th>
                        </thead>

                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}} </td>
                                <td>{{$role->description}} </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card rounded-0 custom-border-secondary mt-5">
                <div class="card-header font-weight-bold">{{ __('Laratrust') }}</div>

                <div class="card-body">
                    <a href="/adminpanel" class="btn btn-info" role="button">Backoffice</a>
                    <a href="https://laratrust.santigarcor.me/docs/6.x/" class="btn btn-link" role="button">Dokumentation</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
