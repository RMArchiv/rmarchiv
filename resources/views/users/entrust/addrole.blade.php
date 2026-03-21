@extends('layouts.app')
@section('pagetitle', 'benutzergruppen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Benutzergruppen</h1>
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
                        <h4 class="alert-heading">{{ trans('app.add_permission_role') }}</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        Vorhandene Gruppen
                    </div>
                    @if($roles->count() <> 0)
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
                                @foreach($roles as $r)
                                    <tr>
                                        <td><a href="{{ action('UserPermissionController@showRole', $r->id) }}">{{ $r->name }}</a></td>
                                        <td>{{ $r->display_name }}</td>
                                        <td>{{ $r->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            Keine Benutzergruppen vorhanden bisher.
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('user.perm.role.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Gruppe hinzufügen
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" id="name" value="" placeholder="admin"/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="dname">Angezeigter Name</label>
                                <input class="form-control" name="dname" id="dname" value="" placeholder="Administrator"/>
                            </div>
                            <div class="form-group">
                                <label for="desc">Beschreibung</label>
                                <input class="form-control" name="desc" id="desc" value="" placeholder="Megaadmin in da house"/>
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
