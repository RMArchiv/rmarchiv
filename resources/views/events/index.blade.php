@extends('layouts.app')
@section('content')
    <div id='content'>
        <h1>eventliste</h1>
        <table id='rmarchivbox_groupmain' class='boxtable pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>status</th>
                <th>eventname</th>
                <th>beginn</th>
                <th>ende</th>
                <th>anmeldungen</th>
                <th>freie plätze</th>
                <th>anmeldung offen</th>
                <th>kommentare</th>
                <th>erstellt am</th>
            </tr>
            </thead>
            @foreach($events as $e)
                <tr>
                    <td>
                        @if($e->start_date > \Carbon\Carbon::now())
                            <span style="color: green;">steht an</span>
                        @elseif($e->start_date < \Carbon\Carbon::now() and $e->end_date > \Carbon\Carbon::now())
                            <span style="color: yellow;">läuft</span>
                        @elseif($e->end_date < \Carbon\Carbon::now())
                            <span style="color: red;">vorbei</span>
                        @endif
                    </td>
                    <td><a href="{{ action('EventController@show', $e->id) }}">{{ $e->title }}</a></td>
                    <td><time datetime='{{ $e->start_date }}' title='{{ $e->start_date }}'>{{ \Carbon\Carbon::parse($e->start_date)->diffForHumans() }}</time></td>
                    <td><time datetime='{{ $e->end_date }}' title='{{ $e->end_date }}'>{{ \Carbon\Carbon::parse($e->end_date)->diffForHumans() }}</time></td>
                    <td>{{ $e->users_registered->count() }}</td>
                    <td>{{ $e->settings->slots }}</td>
                    <td>anmeldung offen</td>
                    <td>{{ $e->comments->count() }}</td>
                    <td><time datetime='{{ $e->created_at }}' title='{{ $e->created_at }}'>{{ \Carbon\Carbon::parse($e->created_at)->diffForHumans() }}</time></td>
                </tr>
            @endforeach

        </table>

        <div class="content">
            wenn du ein neues event anlegen willst, dann mach das gerne <a href="{{ action('EventController@create') }}">hier</a>.
        </div>
    </div>
@endsection