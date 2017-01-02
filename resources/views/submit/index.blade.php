@extends('layouts.app')
@section('pagetitle', 'einsenden')
@section('content')
    @if(Auth::check())
        <div id="content">
            <div class="rmarchivtbl" id="rmarchivbox_submit">
                <h2>Was willst du einsenden?</h2>
                <ul class='boxlist'>
                    <li><a href='{{ url('games/create') }}'>einsenden eines spiels</a></li>
                    <li><a href='{{ url('resources/create') }}'>einsenden von ressourcen</a></li>
                    <li><a href='{{ url('news/create') }}'>einsenden von news</a></li>
                    <li><a href='{{ url('submit/logo') }}'>upload eines logos</a></li>
                    <li><a href='{{ url('logo/vote') }}'>bewerte logos</a></li>
                </ul>
                <h2>Fehlende Dinge</h2>
                <ul class='boxlist'>
                    <li><a href='{{ url('missing/gamescreens') }}'>fehlende spielescreenshots</a></li>
                    <li><a href='{{ url('missing/gamefiles') }}'>fehlende spieledateien</a></li>
                    <li><a href='{{ url('missing/gamedesc') }}'>fehlende spielebeschreibungen</a></li>
                </ul>
                @role(('owner', 'admin'))
                <h2>Admin Only</h2>
                <ul class="boxlist">
                    <li><a href="{{ url('users/perm/role') }}">benutzerberechtigungen</a></li>
                    <li><a href="{{ url('board/create') }}">board kategorie hinzufügen</a></li>
                    <li><a href="{{ url('cdc/create') }}">'coup de coeur' hinzufügen</a></li>
                    <li><a href="{{ url('faq/create') }}">faq hinzufügen</a></li>
                    <li><a href="{{ url('awards/create') }}">award-kategorie hinzufügen</a></li>
                    <li><a href="{{ url('reported/comments') }}"></a>gemeldete kommentare</li>
                </ul>
                @endrole
            </div>
        </div>
    @else
        <div class="rmarchivtbl errorbox">
            <h2>{!! trans('app.errors.submit.no_login.title') !!}</h2>
            <div class="content">
                <strong>{!! trans('app.errors.submit.no_login.message', ['websitetitle' => config('app.name'), 'loginurl' => url('login'), 'registerurl' => url('register')]) !!}</strong>
            </div>
        </div>
    @endif

@endsection
