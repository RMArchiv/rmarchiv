<div class='rmarchivtbl' id='rmarchivbox_topglops'>
    <h2>{{ trans('index.topusers.title') }}</h2>
    <ul class='boxlist'>
        @foreach($topusers as $topuser)
        <li>
            <a href='{{ url('users', $topuser->userid) }}' class='usera' title="{{ $topuser->username }}">
                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $topuser->userid }}' alt="{{ $topuser->username }}" class='avatar' />
            </a>
            <span class='prod'><a href='{{ url('users', $topuser->userid) }}' class='user'>{{ $topuser->username }}</a></span>
            <span class='group'>:: {{ (is_null($topuser->obyx)) ? 0 : $topuser->obyx }} Obyx</span>
        </li>
        @endforeach
    </ul>
    <div class='foot'><a href='{{ url('users') }}'>{{ trans('index.topusers.more') }}</a>...</div>
</div>