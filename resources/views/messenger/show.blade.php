@extends('layouts.app')
@section('pagetitle', 'nachricht lesen')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_bbsview'>
            <h2>{{ $thread->subject }} :: {{ $thread->participantsString(Auth::id()) }}</h2>

            @foreach($thread->messages as $post)
                <div class='content cite-{{ $post->id  }} markdown' id='c{{ $post->id }}'>
                    <div class="userinfo">
                        <b><a href='{{ url('users', $post->user->id) }}' class='user'>{{ $post->user->name }}</a></b>
                        <br>
                        <small>{{ $post->user->roles[0]->display_name}}</small>
                        <br>
                        <br>
                        <a href='{{ url('users', $post->user->id) }}' class='usera' title="{{ $post->user->name }}">
                            <img src='http://ava.rmarchiv.de/?size=160&gender=male&id={{ $post->user->id }}' alt="{{ $post->user->name }}" class='avatar_board'/>
                        </a>
                        <br>
                        <br>
                    </div>
                    <div class="post markdown">
                        {!! \App\Helpers\InlineBoxHelper::GameBox(Markdown::convertToHtml($post->body)) !!}
                    </div>
                </div>
                <div class='foot'>
                    gepostet
                    <a href='{{ route('messages.show', [$post->id]) }}#c{{ $post->id }}'>{{ $post->created_at }}</a>
                </div>
            @endforeach
        </div>

        @if(Auth::check())
            <div class='rmarchivtbl' id='rmarchivbox_bbspost'>
                <h2>poste eine antwort</h2>
                {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                <div class='content'>
                    nachricht:
                    @include('_partials.markdown_editor')
                    <br>
                    <br>
                    weitere user hinzufügen:
                    @if($users->count() > 0)
                        <div class="checkbox">
                            @foreach($users as $user)
                                <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}</label>
                            @endforeach
                        </div>
                    @endif
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