@extends('layouts.app')
@section('pagetitle', $posts->first()->ttitle)
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_bbsview'>
            <h2>{{ $posts->first()->ttitle }}</h2>
            <div class='threadcategory'><b>kategorie:</b> {{ $posts->first()->ctitle }}
            </div>

            @foreach($posts as $post)
            <div class='content cite-{{ $post->tid  }}' id='c{{ $post->pid }}'>{!! $post->pcontent_html !!}</div>
            <div class='foot'>
                <span class='tools' data-cid='{{ $post->pid }}'></span>
                gepostet am
                <a href='{{ route('board.thread.show', [$post->tid]) }}#c{{ $post->pid }}'>{{ $post->pdate }}</a>
                von
                <a href='{{ url('users', $post->uid) }}' class='user'>{{ $post->uname }}</a>
                <a href='{{ url('users', $post->uid) }}' class='usera' title="{{ $post->uname }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $post->uid }}' alt="{{ $post->uname }}" class='avatar'/>
                </a>
            </div>
            @endforeach
        </div>

        @if(Auth::check())
        <div class='rmarchivtbl' id='rmarchivbox_bbspost'>
            <h2>poste eine antwort</h2>
            {!! Form::open(['action' => ['BoardController@store_post', $posts->first()->tid], 'id' => 'frmBBSPost']) !!}
                <input type='hidden' name='catid' value='{{ $posts->first()->cid }}'>
                <div class='content'>
                    nachricht:
                    <textarea name='message' id='message'></textarea>
                    <div><a href='#'><b>markdown</b></a> kann hier genutzt werden</div>
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' id='submit'></div>
            {!! Form::close() !!}
        </div>
        @else
        <div class="rmarchivtbl">
            <h2>leider bist du nicht angemeldet.</h2>
            <div class="content">
                du bist nicht angemeldet.<br>
                um einen thread erstellen zu können, <a href="{{ url('login') }}">logge</a> dich ein.<br>
                wenn du keinen account hast, <a href="{{ url('register') }}">registriere</a> dich doch einfach.
            </div>
        </div>
        @endif
    </div>
@endsection