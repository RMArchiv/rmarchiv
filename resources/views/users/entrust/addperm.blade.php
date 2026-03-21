@extends('layouts.app')
@section('pagetitle', 'berechtigungen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Berechtigungen</h1>
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
                        <h4 class="alert-heading">{{ trans('app.add_permissions') }}</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        Vorhandene Berechtigungen
                    </div>
                    @if($perms->count() <> 0)
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Anzeigename</th>
                                    <th>Beschreibung</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($perms as $r)
                                    <tr>
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $r->display_name }}</td>
                                        <td>{{ $r->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            Keine Berechtigungen vorhanden bisher.
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('user.perm.perm.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Berechtigung hinzufügen
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" id="name" value="" placeholder="create-news"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="dname">Angezeigter Name</label>
                                <input class="form-control" name="dname" id="dname" value="" placeholder="news erstellen"/>
                            </div>
                            <div class="form-group">
                                <label for="desc">Beschreibung</label>
                                <input class="form-control" name="desc" id="desc" value="" placeholder="mit dieser berechtigung darf man news erstellen"/>
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
