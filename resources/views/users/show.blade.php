@extends('layouts.app')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_usermain'>
            <h2> <img src='http://ava.rmarchiv.de/?gender=male&id={{ $user->userid }}' alt="{{ $user->username}}" class='avatar' /> <span>{{ $user->username}}</span> informationen <span id='glops'><span>{{ $user->obyx }}</span> Obyx</span></h2>
            <div class='content'>
                <div class='bigavatar'><img src='http://ava.rmarchiv.de/?size=160&gender=male&id={{ $user->userid }}' alt='big avatar'/></div>
                <ul id='userdata'>
                    <li class='header'>allgemein:</li>
                    <li>
                        <span class='field'>level:</span>
                        {{ $user->rolename }}
                    </li>
                </ul>
            </div>
            <div class='contribheader'>beteiligung an spielen <span>0 Spiele (0 thumbs up, 0 thumbs down)</span> [<a href='#'>show all</a>]</div>
            <div class='contribheader'>spiele hinzugefügt: {{ $user->gamecount }} <span>:: {{ ($user->gamecount * \App\Helpers\DatabaseHelper::getObyxPoints('game-add') ) }} Obeys</span> [<a href='#'>show</a>]</div>
            <div class='contribheader'>entwickler hinzugefügt: {{ $user->devcount  }} <span>:: {{ ($user->devcount * \App\Helpers\DatabaseHelper::getObyxPoints('dev-add')) }} Obeys</span> [<a href='#'>show</a>]</div>
            <div class='contribheader'>kommentare: {{ $user->commentcount }} <span>:: {{ ($user->commentcount * \App\Helpers\DatabaseHelper::getObyxPoints('comment')) }} Obeys</span></div>
            <div class='contribheader'>bewertungen: {{ $user->ratecount }} <span>:: {{ ($user->ratecount * \App\Helpers\DatabaseHelper::getObyxPoints('rating')) }} Obeys</span></div>
            <div class='contribheader'>shoutpox posts: {{ $user->shoutboxcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('shoutbox')) }} Obeys</span> [<a href='#'>show</a>]</div>
            <div class='contribheader'>board topics eröffnet: {{ $user->threadcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('thread-add')) }} Obeys</span> [<a href='#'>show</a>]</div>
            <div class='contribheader'>board posts: {{ $user->postcount }} <span>:: {{ ($user->shoutboxcount * \App\Helpers\DatabaseHelper::getObyxPoints('post-add')) }} Obeys</span> [<a href='#'>show</a>]</div>
            <div class='foot'>account erstellt am {{ $user->usercreated_at }}</div>
        </div>
    </div>
@endsection