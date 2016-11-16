@extends('layouts.app')

@section('content')
    <div id='content'>
        <table id='pouetbox_prodlist' class='boxtable pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>spielname</th>
                <th>entwickler</th>
                <th>release date</th>
                <th>hinzugefügt</th>
                <th><img src='/assets/rate_up.gif' alt='super' /></th>
                <th><img src='/assets/rate_down.gif' alt='scheiße' /></th>
                <th>avg</th>
                <th>popularität</th>
                <th>kommentare</th>
            </tr>
            </thead>

            @foreach($games as $game)
            <tr>
                <td>
                    <span class='typeiconlist'>
                        <span class='typei type_@{{ $game->gametype }}' title='@{{ game.game_type }}'>@{{ game.game_type }}</span>
                    </span>
                    <span class="platformiconlist">
                        <span class="typei type_{{ $game->makershort }}" title="{{ $game->makertitle }}">{{ $game->makertitle }}</span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games', $game->gameid) }}'>
                            {{ $game->gametitle }}
                            @if($game->gamesubtitle != '')
                                <small> - {{ $game->gamesubtitle }}</small>
                            @endif
                        </a>
                    </span>
                    {% if game.cdc > 0 %}
                    <div class="cdcstack">
                        <img src="/assets/cdc.png" title="cdc" alt="cdc">
                    </div>
                    {% endif %}
                </td>
                <td>
                    <a href="{{ url('developer', $game->developerid) }}">{{ $game->developername }}</a>
                </td>
                <td class='date'>releasedatefromgamefiles</td>
                <td class='date'>{{ $game->gamecreated_at }}</td>
                <td class='votes'>{{ $game->voteup or 0 }}</td>
                <td class='votes'>{{ $game->votedown or 0 }}</td>
                <td class='votes'>{{ number_format($game->voteavg, 2) }}&nbsp;
                    @if($game->voteavg > 0)
                    <img src='/assets/rate_up.gif' alt='up' />
                    @elseif($game->voteavg == 0)
                    <img src='/assets/rate_neut.gif' alt='neut' />
                    @elseif($game->voteavg < 0)
                    <img src='/assets/rate_down.gif' alt='down' />
                    @endif
                </td>
                <td><div class='innerbar_solo' style='width: @{{ game.views.percent }}px' title='@{{ game.views.percent }}%'>&nbsp;<span>@{{ game.views.percent }}</span></div></td>
                <td>{{ $game->commentcount }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection