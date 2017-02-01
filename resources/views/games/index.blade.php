@extends('layouts.app')
@section('pagetitle', 'spieleliste')
@section('content')
    <div id='content'>
        <h2>Spiele</h2>
        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
            <thead>
                <tr class='sortable'>
                    <th>
                        @if($orderby == 'title')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['title', 'desc']) }}">spielname</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['title', 'asc']) }}">spielname</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['title', 'asc']) }}">spielname</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'developer.name')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['developer.name', 'desc']) }}">entwickler</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['developer.name', 'asc']) }}">entwickler</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['developer.name', 'asc']) }}">entwickler</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'game.release_date')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['game.release_date', 'desc']) }}">release date</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['game.release_date', 'asc']) }}">release date</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['game.release_date', 'asc']) }}">release date</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'created_at')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('games.index.sorted', ['created_at', 'desc']) }}">hinzugefügt</a>
                            @else
                                <a class="activated reverse" href="{{ route('games.index.sorted', ['created_at', 'asc']) }}">hinzugefügt</a>
                            @endif
                        @else
                            <a class="" href="{{ route('games.index.sorted', ['created_at', 'asc']) }}">hinzugefügt</a>
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
                    @if($game->gamefiles->count() > 0)
                    <span class='typeiconlist'>
                        <span class='typei type_{{ $game->gamefiles->first()->gamefiletype->short }}' title='{{ $game->gamefiles->first()->gamefiletype->title }}'>{{ $game->gamefiles->first()->gamefiletype->title }}</span>
                    </span>
                    @endif
                    <span class="platformiconlist">
                        <span class="typei type_{{ $game->maker->short }}" title="{{ $game->maker->title }}">{{ $game->maker->title }}</span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games', $game->id) }}'>
                            {{ $game->title }}
                            @if($game->subtitle)
                                <small> - {{ $game->subtitle }}</small>
                            @endif
                            <span><img src="/assets/lng/16/{{ strtoupper($game->language->short) }}.png" title="{{ $game->language->name }}"></span>
                        </a>
                    </span>
                        @if($game->cdcs->count() > 0)
                        <div class="cdcstack">
                            <img src="/assets/cdc.png" title="cdc" alt="cdc">
                        </div>
                        @endif
                </td>
                <td>
                    {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($game->id) !!}
                    {{-- <a href="{{ url('developer', $game->developerid) }}">{{ $game->developername }}</a> --}}
                </td>
                <td class='date'>
                    @if(\Carbon\Carbon::parse($game->release_date)->year != -1 )
                        {{ $game->release_date }}
                    @else
                        {{ \Carbon\Carbon::parse(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id))->toDateString() }}
                    @endif
                </td>
                <td class='date'><time datetime='{{ $game->created_at }}' title='{{ $game->created_at }}'>{{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }}</time></td>
                <td class='votes'>{{ $game->vote['up'] or 0 }}</td>
                <td class='votes'>{{ $game->vote['down'] or 0 }}</td>
                <td class='votes'>{{ number_format($game->vote['avg'], 2) }}&nbsp;
                    @if($game->vote['avg'] > 0)
                    <img src='/assets/rate_up.gif' alt='up' />
                    @elseif($game->vote['avg'] == 0)
                    <img src='/assets/rate_neut.gif' alt='neut' />
                    @elseif($game->vote['avg'] < 0)
                    <img src='/assets/rate_down.gif' alt='down' />
                    @endif
                </td>
                @php
                    $perc = \App\Helpers\MiscHelper::getPopularity($game->views, $maxviews);
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $game->comments->count() }}</td>
            </tr>
            @endforeach
            {{ $games->links('vendor.pagination.gamelist') }}
        </table>
    </div>
@endsection