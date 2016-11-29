@extends('layouts.app')
@section('content')
    <div id='content'>
        <h2>Spiele</h2>
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
                    @if(is_null($game->gametype) == false)
                    <span class='typeiconlist'>
                        <span class='typei type_{{ $gametypes[$game->gametype]['short'] }}' title='{{ $gametypes[$game->gametype]['title'] }}'>{{ $gametypes[$game->gametype]['title'] }}</span>
                    </span>
                    @endif
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
                        @if($game->cdccount > 0)
                        <div class="cdcstack">
                            <img src="/assets/cdc.png" title="cdc" alt="cdc">
                        </div>
                        @endif
                </td>
                <td>
                    <a href="{{ url('developer', $game->developerid) }}">{{ $game->developername }}</a>
                </td>
                <td class='date'>{{ $game->releasedate }}</td>
                <td class='date'>{{ $game->gamecreated_at }}</td>
                <td class='votes'>{{ $game->voteup or 0 }}</td>
                <td class='votes'>{{ $game->votedown or 0 }}</td>
                {{ $avg = @(($game->voteup - $game->votedown) / ($game->voteup + $game->votedown)) }}
                <td class='votes'>{{ number_format($avg, 2) }}&nbsp;
                    @if($avg > 0)
                    <img src='/assets/rate_up.gif' alt='up' />
                    @elseif($avg == 0)
                    <img src='/assets/rate_neut.gif' alt='neut' />
                    @elseif($avg < 0)
                    <img src='/assets/rate_down.gif' alt='down' />
                    @endif
                </td>
                @php
                    $perc = \App\Helpers\MiscHelper::getPopularity($game->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ $perc }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $game->commentcount }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection