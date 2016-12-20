@foreach($news as $new)
<div class='rmarchivtbl rmarchivbox_newsbox'>
    <h3><a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a></h3>
    <div class='content'>
        {!! $new->news_html !!}
    </div>
    <div class='foot'>Eingesendet von <a href='{{ url('users', $new->user_id) }}'>{{ $new->name }}</a> :: <time datetime='{{ $new->created_at }}' title='{{ $new->created_at }}'>{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</time> - Kommentare: {{ $new->counter or 0 }}</div>
</div>
@endforeach