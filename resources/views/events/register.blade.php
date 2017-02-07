@extends('layouts.app')
@section('content')
    <div id='content'>
        <h1>anmelden zu: <a href="{{ action('EventController@show', $event->id) }}">{{ $event->title }}</a></h1>
        <div class="rmarchivtbl" id="rmarchivbox_submitnews">
            <h2>anmeldung zum event</h2>
            <div class="content">
                Hier kannst du dich zum oben erwähntem Event anmelden.<br>
                <br>
                Beachte bitte, das die Anmeldung verbindlich sein sollte. <br>
                Oder das du dich zumindest wieder abmeldest, wenn du den Termin nicht wahrnehmen kannst.<br>
                <br>
                <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
                    <thead>
                        <tr>
                            <th style="width: 50%;">
                                <a href="{{ action('EventController@show', $event->id) }}">abbrechen</a>
                            </th>
                            @if($event->settings->reg_allowed == 1 && $event->settings->slots > $event->users_registered->count())
                                <form id="formreg" action="{{ action('EventController@register_store', $event->id) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <th style="text-align: right">
                                        <a href="javascript:" onclick="document.getElementById('formreg').submit();">anmelden</a>
                                    </th>
                                </form>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection