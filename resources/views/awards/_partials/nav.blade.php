@permission(('create-awards'))
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ route('awards.create') }}">{{ trans('awards._partials.nav.add') }}</a>
        </div>
    </div>
</div>
@endpermission