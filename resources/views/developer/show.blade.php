@extends('layouts.app')
@section('pagetitle', 'entwicklerprofil: '. $games->first()->developername)
@section('content')
    <div id='content'>
        <h1>{{ $games->first()->developername }}</h1>
        hinzugefügt am {{ $games->first()->developerdate }} von <a href='{{ url('users', $games->first()->developeruserid) }}' class='user'>{{ $games->first()->developerusername }}</a> <a href='{{ url('users', $games->first()->developeruserid) }}' class='usera' title="{{ $games->first()->developerusername }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $games->first()->developeruserid }}' alt="{{ $games->first()->developerusername }}" class='avatar'/></a>
        <br><br>
        <table id='rmarchivbox_groupmain' class='boxtable pagedtable'>
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

            @foreach($games as $g)
            <tr>
                <td>
                    @if(is_null($g->gametype) == false)
                    <span class='typeiconlist'>
                    <span class='typei type_{{ $gametypes[$g->gametype]['short'] }}' title='{{ $gametypes[$g->gametype]['title'] }}'>{{ $gametypes[$g->gametype]['title'] }}</span>
                </span>
                    @endif
                    <span class='platformiconlist'>
                    <span class='typei type_{{ $g->makershort }}' title='{{ $g->makertitle }}'>$g->makertitle</span>
                </span>
                    <span class='prod'><a href='{{ url('games', $g->gameid) }}'>{{ $g->gametitle }}
                        @if($g->gamesubtitle)
                        <small> - {{ $g->gamesubtitle }}</small>
                        @endif
                    </a></span>
                    @if($g->cdccount > 0)
                        <div class="cdcstack">
                            <img src="/assets/cdc.png" title="cdc" alt="cdc">
                        </div>
                    @endif
                </td>
                <td>
                    {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->gameid) !!}
                </td>
                <td class='date'>{{ $g->releasedate }}</td>
                <td class='date'>{{ $g->gamecreated_at }}</td>
                <td class='votes'>{{ $g->voteup or 0 }}</td>
                <td class='votes'>{{ $g->votedown or 0 }}</td>
                {{ $avg = @(($g->voteup - $g->votedown) / ($g->voteup + $g->votedown)) }}
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
                    $perc = \App\Helpers\MiscHelper::getPopularity($g->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ $perc }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $g->commentcount }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection