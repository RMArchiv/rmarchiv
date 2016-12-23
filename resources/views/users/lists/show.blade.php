@extends('layouts.app')
@section('content')
    <div id="content">
        <div id="prodpagecontainer">
            <div class="rmarchivtbl" id="rmarchivbox_news">
                <h2>{{ $list->title }}</h2>
                <div class="content">
                    {!! $list->desc_html !!}
                </div>
                <div class="foot">
                    {{ trans('app.news.show.submit_by') }} <a href='{{ url('users', $list->user_id) }}'>{{ $list->name }}</a> :: <time datetime='{{ $list->created_at }}' title='{{ $list->created_at }}'>{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</time>
                </div>
            </div>
        </div>

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
                <th>aktionen</th>
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
                    <td class='date'><time datetime='{{ $game->gamecreated_at }}' title='{{ $game->gamecreated_at }}'>{{ \Carbon\Carbon::parse($game->gamecreated_at)->diffForHumans() }}</time></td>
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
                        $perc = \App\Helpers\MiscHelper::getPopularity($game->views, $maxviews);
                    @endphp
                    <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                    <td>{{ $game->commentcount }}</td>
                    <td>
                        @if(Auth::check())
                            @if(Auth::id() == $list->user_id)

                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection