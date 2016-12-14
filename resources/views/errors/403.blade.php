@extends('layouts.app')
@section('content')
    <div id="content">
        <h1>vier null drei</h1>
        <br>
        <h2>Herzlichen Glückwunsch!</h2>
        <br>
        <h3>Du hast eine Seite gefunden, für die du keine Berechtigung hast.</h3>
        <h3>Sei stolz, aber versuche es noch mal <a href="{{ url('/') }}">hiermit</a>.</h3>
    </div>
@endsection