@permission(('create-awards'))
<div class="row">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('awards.create') }}">{{ trans('app.add_award') }}</a>
        </div>
    </div>
</div>
@endpermission