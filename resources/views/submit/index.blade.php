@extends('layouts.app')

@section('content')
    @if(Auth::check() == true)
        <div id="content">
            <div class="rmarchivtbl" id="rmarchivbox_submit">
                <h2>Was willst du einsenden?</h2>
                <ul class='boxlist'>
                    <li><a href='/?page=submit&type=game'>einsenden eines spiels</a></li>
                    <li><a href='/?page=submit&type=creator'>einsenden eines entwicklers</a></li>
                    <li><a href='/?page=submit&type=ressource'>einsenden von ressourcen</a></li>
                    <li><a href='/?page=submit&type=news'>einsenden von news</a></li>
                    <li><a href='/?page=submit&type=logo'>upload eines logos</a></li>
                    <li><a href='/?page=submit&type=vote_logo'>bewerte logos</a></li>
                </ul>
                @if($user->settings->is_admin)
                <h2>Admin Only</h2>
                <ul class="boxlist">
                    <li><a href="/?page=submit&type=changelog">changelog hinzufügen</a></li>
                    <li><a href="/?page=submit&type=cdc">'coup de coeur' hinzufügen</a></li>
                    <li><a href="/?page=submit&type=maker">maker hinzufügen</a></li>
                    <li><a href="/?page=submit&type=genre">genre hinzufügen</a></li>
                    <li><a href="/?page=submit&type=faq">faq hinzufügen</a></li>
                    <li><a href="/?page=submit&type=award">award-kategorie hinzufügen</a></li>
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
