@extends('layouts.app')
@section('pagetitle', 'benutzer reports')
@section('content')
    <div id="content">
        @if(count($reports) > 0)
            <div id="prodpagecontainer">
                <h2>benutzer reports</h2>
                <table id="rmarchivbox_newslist" class="boxtable pagedtable">
                    <thead>
                    <tr class="sortable">
                        <th>user</th>
                        <th>datum</th>
                        <th>gemeldetes spiel</th>
                        <th>begründung für meldung</th>
                        <th>status</th>
                        <th>bemerkung</th>
                        <th>letzte änderung am</th>
                        <th>letzte änderung von</th>
                        <th>aktionen</th>
                    </tr>
                    </thead>
                    @foreach($reports as $r)
                        <tr>
                            <td>
                                <a href="{{ url('/user', $r->user_id) }}" class="usera" title="{{ $r->user->name }}">
                                    <img src="//ava.rmarchiv.de/?gender=male&amp;id={{ $r->user_id }}" alt="{{ $r->user->name }}" class="avatar">
                                </a> <a href="{{ url('/user', $r->user_id) }}" class="user">{{ $r->user->name }}</a>
                            </td>
                            <td><time datetime='{{ $r->created_at }}' title='{{ $r->created_at }}'>{{ \Carbon\Carbon::parse($r->created_at)->diffForHumans() }}</time></td>
                            <td>{{ $r->game->title }}</td>
                            <td>{{ $r->reason }}</td>
                            <td>{{ $r->closed }}</td>
                            <td>{{ $r->remarks }}</td>
                            <td><time datetime='{{ $r->closed_at }}' title='{{ $r->closed_at }}'>{{ \Carbon\Carbon::parse($r->closed_at)->diffForHumans() }}</time></td>
                            <td>
                                @if($r->closed == 1)
                                    <a href="{{ url('/user', $r->user_closed->id) }}" class="usera" title="{{ $r->user_closed->name }}">
                                        <img src="//ava.rmarchiv.de/?gender=male&amp;id={{ $r->user_closed->id }}" alt="{{ $r->user_closed->name }}" class="avatar">
                                    </a> <a href="{{ url('/user', $r->user_closed->id) }}" class="user">{{ $r->user_closed->name }}</a>
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->can('admin-games'))
                                    @if($r->closed == 1)
                                        [<a href="{{ action('ReportController@open_ticket', $r->id) }}">öffnen</a>]
                                    @else
                                        [<a href="{{ action('ReportController@close_ticket', $r->id) }}">schließen</a>]
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        @else
            <h2>es sind noch keine reports vorhanden.</h2>
        @endif
    </div>
@endsection