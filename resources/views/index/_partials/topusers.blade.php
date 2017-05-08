<div class="panel panel-default">
    <div class="panel-heading">{{ trans('index.topusers.title') }}</div>
    <ul class='list-group'>
        @foreach($topusers as $topuser)
            <li class="list-group-item">
                <a href='{{ url('users', $topuser->userid) }}' class='usera' title="{{ $topuser->username }}">
                    <img width="16px" src='http://ava.rmarchiv.de/?gender=male&id={{ $topuser->userid }}' alt="{{ $topuser->username }}" class='avatar' />
                </a>
                <span class='prod'><a href='{{ url('users', $topuser->userid) }}' class='user'>{{ $topuser->username }}</a></span>
                <span class='group'>:: {{ (is_null($topuser->obyx)) ? 0 : $topuser->obyx }} Obyx</span>
            </li>
        @endforeach
    </ul>
</div>