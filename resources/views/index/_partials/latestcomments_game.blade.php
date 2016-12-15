<div class='rmarchivtbl' id='rmarchivbox_latestcomments'>
    <h2>
        die neuesten kommentare
    </h2>
    <ul class='boxlist boxlisttable'>
        @foreach($latestcomments as $com)
        <li>
            <span class='rowprod'>
                <span class='prodentry'>
                    <span class='typeiconlist'>
                        <span class='typei type_{{ $gametypes[$com->gametype]['short'] }}' title='{{ $gametypes[$com->gametype]['title'] }}'>
                            {{ $gametypes[$com->gametype]['title'] }}
                        </span>
                    </span>
                    <span class='platformiconlist'>
                        <span class='typei type_{{ $com->makershort }}' title='{{ $com->makertitle }}'>
                            {{ $com->makertitle }}
                        </span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games', $com->gameid) }}'>{{ $com->gametitle }}
                            @if($com->gamesubtitle)
                                <small> - {{ $com->gamesubtitle }}</small>
                            @endif
                        </a>
                    </span>
                    <span class='group'>:: <a href='{{ url('developer', $com->developerid) }}'>{{ $com->developername }}</a>
                    </span>
                </span>
            </span>
            <span class='rowuser'>
                <a class='usera' href='{{ url('users', $com->userid) }}' title="{{ $com->username }}">
                    <img alt="{{ $com->username }}" class='avatar' src='http://ava.rmarchiv.de/?gender=male&id={{ $com->userid }}'>
                </a>
            </span>
        </li>
        @endforeach
    </ul>
    <div class='foot'>
        .
    </div>
</div>