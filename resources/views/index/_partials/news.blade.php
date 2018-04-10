@foreach($news as $new)
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a>
                </div>
                <div class="card-body">
                    {!! \App\Helpers\InlineBoxHelper::GameBox($new->news_html) !!}
                </div>
                <div class="card-footer">
                    {{ trans('app.submitted_by') }} <a href='{{ url('users', $new->user->id) }}'>{{ $new->user->name }}</a> :: <time datetime='{{ $new->created_at }}' title='{{ $new->created_at }}'>{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</time> - {{ trans('app.comments') }}: {{ $new->comments->count() }}
                </div>
            </div>
        </div>
    </div>
@endforeach

