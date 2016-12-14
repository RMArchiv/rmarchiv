@permission(('create-awards'))
<nav>
    <ul>
        <li style="margin-left: 0"><a href="{{ route('awards.index') }}">übersicht</a></li>
        <li style="margin-left: 0"><a href="{{ route('awards.create') }}">award hinzufügen</a></li>
    </ul>
</nav>
@endpermission