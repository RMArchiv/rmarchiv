@permission(('create-awards'))
<nav>
    <ul>
        <li style="margin-left: 0"><a href="{{ route('awards.index') }}">{{ trans('awards._partials.nav.overview') }}</a></li>
        <li style="margin-left: 0"><a href="{{ route('awards.create') }}">{{ trans('awards._partials.nav.add') }}</a></li>
    </ul>
</nav>
@endpermission