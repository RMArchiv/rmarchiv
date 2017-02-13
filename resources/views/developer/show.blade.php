@extends('layouts.app')
@section('pagetitle', 'entwicklerprofil: '. $games->first()->developer->name)
@section('content')
    <div id='content'>
        <h1>{{ $games->first()->developer->name }}</h1>
        hinzugefügt am {{ $games->first()->developer->created_at }} von <a href='{{ url('users', $games->first()->developer->user->id) }}' class='user'>{{ $games->first()->developer->user->name }}</a> <a href='{{ url('users', $games->first()->developer->user->id) }}' class='usera' title="{{ $games->first()->developer->user->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $games->first()->developer->user->id }}' alt="{{ $games->first()->developer->user->name }}" class='avatar'/></a>
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
                    @if($g->game->gamefiles()->count() != 0)
                    @if(is_null($g->game->gamefiles->first()->gamefiletype) == false)
                        <span class='typeiconlist'>
                            <span class='typei type_{{ $g->game->gamefiles->first()->gamefiletype->short }}' title='{{ $g->game->gamefiles->first()->gamefiletype->title }}'>{{ $g->game->gamefiles->first()->gamefiletype->title }}</span>
                        </span>
                    @endif
                    @endif
                    <span class='platformiconlist'>
                    <span class='typei type_{{ $g->game->maker->short }}' title='{{ $g->game->maker->title }}'>$g->game->maker->title</span>
                </span>
                    <span class='prod'><a href='{{ url('games', $g->game->id) }}'>{{ $g->game->title }}
                        @if($g->game->subtitle)
                        <small> - {{ $g->game->subtitle }}</small>
                        @endif
                    </a></span>
                    @if($g->game->cdcs->count() > 0)
                        <div class="cdcstack">
                            <img src="/assets/cdc.png" title="cdc" alt="cdc">
                        </div>
                    @endif
                </td>
                <td>
                    {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->game_id) !!}
                </td>
                <td class='date'>{{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($g->game_id) }}</td>
                <td class='date'>{{ $g->game->created_at }}</td>
                <td class='votes'>{{ $g->game->votes['up'] or 0 }}</td>
                <td class='votes'>{{ $g->game->votes['down'] or 0 }}</td>
                <td class='votes'>{{ $g->game->votes['avg'] or 0 }}&nbsp;
                    @if($g->game->votes['avg'] > 0)
                        <img src='/assets/rate_up.gif' alt='up' />
                    @elseif($g->game->votes['avg'] == 0)
                        <img src='/assets/rate_neut.gif' alt='neut' />
                    @elseif($g->game->votes['avg'] < 0)
                        <img src='/assets/rate_down.gif' alt='down' />
                    @endif
                </td>
                @php
                    $perc = \App\Helpers\MiscHelper::getPopularity($g->game->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ $perc }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $g->game->comments->count() }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection