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
                <td>status</td>
                <td>eventname</td>
                <td>beginn</td>
                <td>ende</td>
                <td>anmeldungen</td>
                <td>freie plätze</td>
                <td>anmeldung offen</td>
                <td>kommentare</td>
                <td>erstellt am</td>
            @endforeach
        </table>

        <div class="content">
            wenn du ein neues event anlegen willst, dann mach das gerne <a href="{{ action('EventController@create') }}">hier</a>.
        </div>
    </div>
@endsection