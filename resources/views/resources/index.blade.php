@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <div id="content">
        <h1>ressourcen übersicht (die neuesten 20)</h1>
        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>typ</th>
                <th>kategorie</th>
                <th>von</th>
                <th>am</th>
                <th>titel</th>
                <th>content typ</th>
                <th><img src='/assets/rate_up.gif' alt='super' /></th>
                <th><img src='/assets/rate_down.gif' alt='scheiße' /></th>
                <th>avg</th>
                <th>popularität</th>
                <th>kommentare</th>
            </tr>
            </thead>

            @foreach($resources as $res)
                <tr>
                    <td>{{ $res->restype }}</td>
                    <td>{{ $res->rescat }}</td>
                    <td class=>{{ $res->username }}</td>
                    <td class='date'><time datetime='{{ $res->rescreatedat }}' title='{{ $res->rescreatedat }}'>{{ \Carbon\Carbon::parse($res->rescreatedat)->diffForHumans() }}</time></td>
                    <td><a href="{{ route('resources.show', [$res->restype, $res->rescat, $res->resid]) }}">{{ $res->restitle }}</a></td>
                    <td>{{ $res->contenttype }}</td>
                    <td class='votes'>{{ $res->voteup or 0 }}</td>
                    <td class='votes'>{{ $res->votedown or 0 }}</td>
                    @php $avg = @(($res->voteup - $res->votedown) / ($res->voteup + $res->votedown)) @endphp
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
                        //$perc = \App\Helpers\MiscHelper::getPopularity($game->views, $maxviews);
                    @endphp
                    <td><div class='innerbar_solo' style='width: @{{ $perc }}%' title='@{{ number_format($perc, 2) }}%'><span>@{{ $perc }}</span></div></td>
                    <td>{{ $res->commentcount }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection