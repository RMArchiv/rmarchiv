@extends('layouts.app')
@section('pagetitle', $posts->first()->ttitle)
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_bbsview'>
            <h2>{{ $posts->first()->ttitle }}
                @permission(('mod-threads'))
                    @if($posts->first()->threadclosed == 0)
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->pid, 1]) }}">schließen</a>
                    @else
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->pid, 0]) }}">öffnen</a>
                    @endif
                @endpermission
            </h2>
            <div class='threadcategory'><b>kategorie:</b> <a href="{{ url('board/cat', $posts->first()->pcatid) }}">{{ $posts->first()->ctitle }}</a>
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
            @if($post->threadclosed == 0)
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
            @else
                <h2>Thread geschlossen</h2>
                <div class="content">
                    der thread wurde geschlossen.<br>
                    du kannst hier also nichts posten.
                </div>
            @endif
        </div>
        @else
        <div class="rmarchivtbl">
            <h2>leider bist du nicht angemeldet.</h2>
            <div class="content">
                du bist nicht angemeldet.<br>
                um einen post erstellen zu können, <a href="{{ url('login') }}">logge</a> dich ein.<br>
                wenn du keinen account hast, <a href="{{ url('register') }}">registriere</a> dich doch einfach.
            </div>
        </div>
        @endif
    </div>
@endsection