@extends('layouts.app')
@section('pagetitle', $posts->first()->thread->title)
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_bbsview'>
            <h2>{{ $posts->first()->thread->title }}
                @permission(('mod-threads'))
                    @if($posts->first()->thread->closed == 0)
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 1]) }}">schließen</a>
                    @else
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 0]) }}">öffnen</a>
                    @endif
                @endpermission
            </h2>
            <div class='threadcategory'><b>kategorie:</b> <a href="{{ url('board/cat', $posts->first()->cat->id) }}">{{ $posts->first()->cat->title }}</a>
            </div>
            {{ $posts->links('vendor/pagination/board_thread') }}
            @foreach($posts as $post)
            <div class='content cite-{{ $post->thread->id  }}' id='c{{ $post->id }}'>{!! $post->content_html !!}</div>
            <div class='foot'>
                @if(Auth::id() == $post->user->id)
                <span class='tools' data-cid='{{ $post->id }}'>
                    [<a href="{{ route('board.post.edit', [$post->thread->id, $post->id]) }}" data-rel="popup">bearbeiten</a>]
                </span>
                @endif
                gepostet
                <a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}'><time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time></a>
                @if($post->updated_at)
                    - editiert {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                @endif
                von
                <a href='{{ url('users', $post->user->id) }}' class='user'>{{ $post->user->name }}</a>
                <a href='{{ url('users', $post->user->id) }}' class='usera' title="{{ $post->user->name }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $post->user->id }}' alt="{{ $post->user->name }}" class='avatar'/>
                </a>
            </div>
            @endforeach
            {{ $posts->links('vendor/pagination/board_thread') }}
        </div>

        @if(Auth::check())
        <div class='rmarchivtbl' id='rmarchivbox_bbspost'>
            @if($post->thread->closed == 0)
                <h2>poste eine antwort</h2>
                {!! Form::open(['action' => ['BoardController@store_post', $posts->first()->thread->id], 'id' => 'frmBBSPost']) !!}
                    <input type='hidden' name='catid' value='{{ $posts->first()->cat->id }}'>
                    <div class='content'>
                        nachricht:
                        <textarea name='message' id='message'></textarea>
                        <script type="text/javascript">
                            $(function() {
                                $('textarea').inlineattachment({
                                    uploadUrl: 'http://rmarchiv.de/attachment/upload',
                                });
                            });
                        </script>
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