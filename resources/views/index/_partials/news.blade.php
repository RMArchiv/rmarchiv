@foreach($news as $new)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a>
                </div>
                <div class="panel-body">
                    {!! $new->news_html !!}
                </div>
                <div class="panel-footer">
                    {{ trans('index.news.submit_by') }} <a href='{{ url('users', $new->user->id) }}'>{{ $new->user->name }}</a> :: <time datetime='{{ $new->created_at }}' title='{{ $new->created_at }}'>{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</time> - {{ trans('index.news.comments') }}: {{ $new->comments->count() }}
                </div>
            </div>
        </div>
    </div>
@endforeach

