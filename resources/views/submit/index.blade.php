@extends('layouts.app')

@section('content')
    @if(Auth::check() == true)
        <div id="content">
            <div class="rmarchivtbl" id="rmarchivbox_submit">
                <h2>Was willst du einsenden?</h2>
                <ul class='boxlist'>
                    <li><a href='{{ url('submit/game') }}'>einsenden eines spiels</a></li>
                    <li><a href='{{ url('submit/developer') }}'>einsenden eines entwicklers</a></li>
                    <li><a href='{{ url('submit/resources') }}'>einsenden von ressourcen</a></li>
                    <li><a href='{{ url('submit/news') }}'>einsenden von news</a></li>
                    <li><a href='{{ url('submit/logo') }}'>upload eines logos</a></li>
                    <li><a href='#'>bewerte logos</a></li>
                </ul>
                @if($user->settings->is_admin)
                <h2>Admin Only</h2>
                <ul class="boxlist">
                    <li><a href="#">changelog hinzufügen</a></li>
                    <li><a href="#">'coup de coeur' hinzufügen</a></li>
                    <li><a href="#">maker hinzufügen</a></li>
                    <li><a href="#">genre hinzufügen</a></li>
                    <li><a href="#">faq hinzufügen</a></li>
                    <li><a href="#">award-kategorie hinzufügen</a></li>
                </ul>
                @endif
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
