@extends('layouts.app')
@section('pagetitle', 'benutzerberechtigungen bearbeiten')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Benutzerberechtigungen bearbeiten</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('users.entrust.partials.nav')
            </div>
            <div class="col-md-8">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Benutzerberechtigungen</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.perm.user.update', $user) }}">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $user->name }} &lt;{{ $user->email }}&gt;
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                Gruppen vergeben gebündelte Berechtigungen. Direkte Berechtigungen gelten zusätzlich nur für diesen Benutzer.
                            </p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            Gruppen
                        </div>
                        <div class="card-body">
                            @if($roles->count() <> 0)
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" @checked(in_array($role->id, $assignedRoleIds))>
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    {{ $role->name }}
                                                    @if($role->display_name)
                                                        <small class="text-muted d-block">{{ $role->display_name }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                Keine Gruppen vorhanden.
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Direkte Berechtigungen
                        </div>
                        <div class="card-body">
                            @if($permissions->count() <> 0)
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" @checked(in_array($permission->id, $assignedPermissionIds))>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                    @if($permission->display_name)
                                                        <small class="text-muted d-block">{{ $permission->display_name }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                Keine Berechtigungen vorhanden.
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <a class="btn btn-outline-secondary" href="{{ route('user.perm.user.index') }}">Zurück</a>
                                <input class="btn btn-primary" type="submit" value="Speichern">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
