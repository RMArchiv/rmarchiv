@permission(('create-awards'))
<nav>
    <ul>
        <li style="margin-left: 0"><a href="{{ route('awards.index') }}">{{ trans('app.awards.nav.overview') }}</a></li>
        <li style="margin-left: 0"><a href="{{ route('awards.create') }}">{{ trans('app.awards.nav.add') }}</a></li>
    </ul>
</nav>
@endpermission