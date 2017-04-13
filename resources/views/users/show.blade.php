@extends('layouts.app')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_usermain'>
            <h2> <img src='http://ava.rmarchiv.de/?gender=male&id={{ $user->userid }}' alt="{{ $user->username}}" class='avatar' /> <span>{{ $user->username}}</span> informationen <span id='glops'><span>{{ $user->obyx }}</span> Obyx</span></h2>
            <div class='content'>
                <div class='bigavatar'><img src='http://ava.rmarchiv.de/?size=160&gender=male&id={{ $user->userid }}' alt='big avatar'/></div>
                <ul id='userdata'>
                    <li class='header'>{{ trans('user.show.informations') }}:</li>
                    <li>
                        <span class='field'>{{ trans('user.show.level') }}:</span>
                        {{ $user->rolename }}
                    </li>
                </ul>
            </div>
            <div class='contribheader'>{{ trans('user.show.gamecredits') }} <span>0 {{ trans('user.show.games') }} (0 thumbs up, 0 thumbs down)</span> [<a href='#'>show all</a>]</div>
            <div class='contribheader'>{{ trans('user.show.games_added') }}: {{ $user->gamecount }} <span>:: {{ ($user->gamecount * \App\Helpers\DatabaseHelper::getObyxPoints('game-add') ) }} obyx</span> [<a href='#'>{{ trans('user.show.show') }}</a>]</div>
            <div class='contribheader'>{{ trans('user.show.developer_added') }}: {{ $user->devcount  }} <span>:: {{ ($user->devcount * \App\Helpers\DatabaseHelper::getObyxPoints('dev-add')) }} obyx</span> [<a href='#'>{{ trans('user.show.show') }}</a>]</div>
            <div class='contribheader'>{{ trans('user.show.comments') }}: {{ $user->commentcount }} <span>:: {{ ($user->commentcount * \App\Helpers\DatabaseHelper::getObyxPoints('comment')) }} obyx</span></div>
            <div class='contribheader'>{{ trans('user.show.ratings') }}: {{ $user->ratecount }} <span>:: {{ ($user->ratecount * \App\Helpers\DatabaseHelper::getObyxPoints('rating')) }} obyx</span></div>
            <div class='contribheader'>{{ trans('user.show.shoutbox') }}: {{ $user->shoutboxcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('shoutbox')) }} obyx</span> [<a href='#'>{{ trans('user.show.show') }}</a>]</div>
            <div class='contribheader'>{{ trans('user.show.topics') }}: {{ $user->threadcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('thread-add')) }} obyx</span> [<a href='#'>{{ trans('user.show.show') }}</a>]</div>
            <div class='contribheader'>{{ trans('user.show.posts') }}: {{ $user->postcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('post-add')) }} obyx</span> [<a href='#'>{{ trans('user.show.show') }}</a>]</div>
            <div class="contribheader">{{ trans('user.lists') }}: {{$user->listcount}} <span>:: </span>[<a href='{{ action('UserListController@index', $user->userid) }}'>{{ trans('user.show.show') }}</a>]</div>
            <div class='foot'>{{ trans('user.show.created_at') }} {{ $user->usercreated_at }}</div>
        </div>
    </div>
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <h2>{{ trans('user.show.last_activity') }}</h2>
            <ul class="boxlist">
                @foreach($obyx as $o)
                    <li><time datetime='{{ $o->created_at }}' title='{{ $o->created_at }}'>{{ \Carbon\Carbon::parse($o->created_at)->diffForHumans() }}</time>
                        <br>{!! $o->obyx->value !!} {{ trans('user.show.obyx_for') }}: {{ $o->obyx->reason_visible }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection