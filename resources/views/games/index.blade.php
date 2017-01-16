@extends('layouts.app')
@section('pagetitle', 'spieleliste')
@section('content')
    <div id='content'>
        <h2>Spiele</h2>
        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
            <thead>
                <tr class='sortable'>
                    <th>
                        @if($orderby == 'gametitle')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['gametitle', 'desc']) }}">spielname</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['gametitle', 'asc']) }}">spielname</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['gametitle', 'asc']) }}">spielname</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'developername')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['developername', 'desc']) }}">entwickler</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['developername', 'asc']) }}">entwickler</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['developername', 'asc']) }}">entwickler</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'releasedate')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['releasedate', 'desc']) }}">release date</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['releasedate', 'asc']) }}">release date</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['releasedate', 'asc']) }}">release date</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'gamecreated_at')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['gamecreated_at', 'desc']) }}">hinzugefügt</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['gamecreated_at', 'asc']) }}">hinzugefügt</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['gamecreated_at', 'asc']) }}">hinzugefügt</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'voteup')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['voteup', 'desc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'votedown')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['votedown', 'desc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'avg')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['avg', 'desc']) }}">avg</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['avg', 'asc']) }}">avg</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['avg', 'asc']) }}">avg</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'views')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['views', 'desc']) }}">popularität</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['views', 'asc']) }}">popularität</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['views', 'asc']) }}">popularität</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'commentcount')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['commentcount', 'desc']) }}">kommentare</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['commentcount', 'asc']) }}">kommentare</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['commentcount', 'asc']) }}">kommentare</a>
                        @endif
                    </th>
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
                            <span><img src="/assets/lng/16/{{ strtoupper($game->langshort) }}.png" title="{{ $game->langname }}"></span>
                        </a>
                    </span>
                        @if($game->cdccount > 0)
                        <div class="cdcstack">
                            <img src="/assets/cdc.png" title="cdc" alt="cdc">
                        </div>
                        @endif
                </td>
                <td>
                    {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($game->gameid) !!}
                    {{-- <a href="{{ url('developer', $game->developerid) }}">{{ $game->developername }}</a> --}}
                </td>
                <td class='date'>{{ $game->releasedate }}</td>
                <td class='date'><time datetime='{{ $game->gamecreated_at }}' title='{{ $game->gamecreated_at }}'>{{ \Carbon\Carbon::parse($game->gamecreated_at)->diffForHumans() }}</time></td>
                <td class='votes'>{{ $game->voteup or 0 }}</td>
                <td class='votes'>{{ $game->votedown or 0 }}</td>
                @php $avg = @(($game->voteup - $game->votedown) / ($game->voteup + $game->votedown)) @endphp
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
                    $perc = \App\Helpers\MiscHelper::getPopularity($game->views, $maxviews);
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $game->commentcount }}</td>
            </tr>
            @endforeach
            {{ $games->links('vendor.pagination.gamelist') }}
        </table>
    </div>
@endsection