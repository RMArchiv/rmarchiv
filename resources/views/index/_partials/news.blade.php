@foreach($news as $new)
<div class='rmarchivtbl rmarchivbox_newsbox'>
    <h3>{{ $new->title }}</h3>
    <div class='content'>
        {!! $new->news_html !!}
    </div>
    <div class='foot'>Eingesendet von <a href='{{ url('users', $new->user_id) }}'>{{ $new->name }}</a> am {{ $new->created_at }}</div>
</div>
@endforeach