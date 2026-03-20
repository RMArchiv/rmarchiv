<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ trans('app.tag_cloud') }}
            </div>
            <div class="card-body">
                {!! $tagCloudHtml !!}
            </div>
            <div class="card-footer">
                <a href="{{ url('tags') }}">{{ trans('app.more') }}...</a>
            </div>
        </div>
    </div>
</div>
