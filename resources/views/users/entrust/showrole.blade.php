@extends('layouts.app')
@section('pagetitle', 'gruppe verwalten')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Gruppe verwalten</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('users.entrust.partials.nav')
            </div>
            <div class="col-md-8">
                @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">{{ trans('app.permission_show_roles') }}</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        Zugewiesene Berechtigungen
                    </div>
                    @if($perms->count() <> 0)
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Anzeigename</th>
                                    <th>Beschreibung</th>
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($perms as $r)
                                    <tr>
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $r->display_name }}</td>
                                        <td>{{ $r->description }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-danger" href="{{ route('user.perm.removefromrole', [$roleid, $r->id]) }}">Löschen</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            Dieser Gruppe wurden keine Berechtigungen zugewiesen.
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('user.perm.permtorole', $roleid) }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Berechtigung hinzufügen
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for='perm'>Berechtigung verknüpfen</label>
                                <select class="form-control" name='perm' id='perm'>
                                    <option value="0">Bitte Berechtigung wählen</option>
                                    @foreach($permstoadd as $perm)
                                        <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <input class="btn btn-primary" type="submit" value="Senden">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
