<li class="list-group-item media" style="margin-top: 0px;">
    @php $cat = $cats->where('id', '=', $id)->first() @endphp

    <a class="float-end" href="{{ route('board.cat.show', isset($cat)?$cat->id:0) }}"><span class="badge">{{ $count = \App\Models\BoardPost::whereCatId($cat?->id)?->count() ?? 0 }}</span></a>

    @if($count != 0 && isset($cat->last_user))
        <a class="float-start" href="{{ url('users', $cat->last_user->id) }}"><img class="me-3" width="42px" src="//{{ config('app.avatar_path') }}?size=42&gender=male&id={{ $cat->last_user->id }}" alt="{{ $cat->last_user->name }}"></a>
    @endif

    <div class="thread-info">
        <div class="media-heading">
            <a href="{{ route('board.cat.show', isset($cat)?$cat->id:0) }}">{{ isset($cat)?$cat->title:"" }}</a>
        </div>
        <div class="media-body" style="font-size: 12px;">
            @if($count != 0 && isset($cat) ? isset($cat->last_user) : false)
            {{ trans('app.last_reply') }}
                <time datetime='{{ $cat->last_created_at }}' title='{{ $cat->last_created_at }}'>{{ \Carbon\Carbon::parse($cat->last_created_at)->diffForHumans() }}</time> {{ trans('app.by') }}
                <a href='{{ url('users', $cat->last_user_id) }}' class='usera' title="{{ $cat->last_user->name }}">
                    <img width="16px" class="img-rounded" src='//{{ config('app.avatar_path') }}?size=16&gender=male&id={{ $cat->last_user->id }}' alt="{{ $cat->last_user->name }}"/>
                </a> <a href='{{ url('users', $cat->last_user->id) }}' class='user'>{{ $cat->last_user->name }}</a>
            @endif
        </div>
    </div>
</li>