@extends('layouts.app')
@section('pagetitle', 'benutzerberechtigungen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Benutzerberechtigungen</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('users.entrust.partials.nav')
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Benutzer suchen
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('user.perm.user.index') }}">
                            <div class="input-group">
                                <input class="form-control" type="search" name="q" value="{{ $search }}" placeholder="Name oder E-Mail">
                                <button class="btn btn-primary" type="submit">Suchen</button>
                                @if($search !== '')
                                    <a class="btn btn-outline-secondary" href="{{ route('user.perm.user.index') }}">Zurücksetzen</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Benutzer
                    </div>
                    @if($users->count() <> 0)
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Gruppen</th>
                                    <th>Direkte Berechtigungen</th>
                                    <th>Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @forelse($user->roles as $role)
                                                <span class="badge text-bg-secondary">{{ $role->name }}</span>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($user->permissions as $permission)
                                                <span class="badge text-bg-secondary">{{ $permission->name }}</span>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('user.perm.user.edit', $user) }}">Bearbeiten</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    @else
                        <div class="card-body">
                            Keine Benutzer gefunden.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
