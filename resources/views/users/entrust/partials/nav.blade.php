<div class="card mb-3">
    <div class="card-header">
        Benutzerberechtigungen
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ url('/users/perm/role') }}" class="list-group-item list-group-item-action{{ request()->is('users/perm/role') || request()->is('users/perm/role/*') ? ' active' : '' }}">
            Gruppen
        </a>
        <a href="{{ url('/users/perm/permissions') }}" class="list-group-item list-group-item-action{{ request()->is('users/perm/permissions') || request()->is('users/perm/permissions/*') ? ' active' : '' }}">
            Berechtigungen
        </a>
    </div>
</div>
