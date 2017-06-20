@permission(('create-awards'))
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ route('awards.create') }}">{{ trans('app.add_award') }}</a>
        </div>
    </div>
</div>
@endpermission