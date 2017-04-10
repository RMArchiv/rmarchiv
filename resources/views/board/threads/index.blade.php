@extends('layouts.app')
@section('content')
    <div id="content">
        @if($threads)
            <h2>
                @if($threads->count() != 0)
                    {{ $threads->first()->cat->title }}
                @else
                    Neuer Thread
                @endif
            </h2>
            <table id="rmarchivbox_bbslist" class="boxtable pagedtable">
                <thead>
                <tr>
                    <th id='th_firstpost'>geöffnet</th>
                    <th id='th_userfirstpost'>von</th>
                    <th id='th_category'>kategorie</th>
                    <th id='th_topic'>thema</th>
                    <th id='th_count'>antworten</th>
                    <th id='th_lastpost'>letzter post</th>
                    <th id='th_userlastpost'>von</th>
                </tr>
                </thead>

                @foreach($threads as $thread)
                    <tr @if(\App\Helpers\DatabaseHelper::isThreadUnread($thread->id) === true) style="font-weight: bold;" @endif>
                        <td>
                            <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                        </td>
                        <td>
                            <a href='{{ url('users', $thread->user->id) }}' class='usera' title="{{ $thread->user->name }}">
                                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->user->id }}' alt="{{ $thread->user->name }}" class='avatar'/>
                            </a> <a href='{{ url('users', $thread->user->id) }}' class='user'>{{ $thread->user->name }}</a>
                        </td>
                        <td><a href="{{ route('board.cat.show', $thread->cat->id) }}">{{ $thread->cat->title }}</a></td>
                        <td><a href="{{ route('board.thread.show', $thread->id) }}">
                                @if($thread->closed == 1)
                                    <img src="/assets/lock.png">
                                @endif
                                @if($t->votes)
                                    <img src="/assets/stats.gif">
                                @endif
                                {{ $thread->title }}</a></td>
                        <td>{{ $thread->posts->count() }}</td>
                        <td>
                            <time datetime='{{ $thread->last_created_at }}' title='{{ $thread->last_created_at }}'>{{ \Carbon\Carbon::parse($thread->last_created_at)->diffForHumans() }}</time>
                        </td>
                        <td>
                            <a href='{{ url('users', $thread->last_user->id) }}' class='usera' title="{{ $thread->last_user->name }}">
                                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->last_user->id }}' alt="{{ $thread->last_user->name }}" class='avatar'/>
                            </a> <a href='{{ url('users', $thread->last_user->id) }}' class='user'>{{ $thread->last_user->name }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>diese kategorie hat keine threads</h2>
        @endif

        @if(Auth::check())
            <div class='rmarchivtbl' id='rmarchivbox_bbsopen'>
                <h2>erstelle einen neuen thread</h2>
                {!! Form::open(['route' => ['board.thread.store']]) !!}
                <input name="category" value="{{ app('request')->input('cat_id') }}" type="hidden" />
                <div class='content'>
                    <label for='topic'>titel:</label>
                    <input name='topic' id='topic'/>

                    <label for='message'>nachricht:</label>
                    @include('_partials.markdown_editor')
                    <div><a href='#'><b>markdown</b></a> ist hier möglich.</div>
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' id='submit'></div>
                {!! Form::close() !!}
            </div>
        @else
            <div class="rmarchivtbl" id="rmarchivbox_bbsopen">
                <h2>du bist nicht angemeldet.</h2>
                <div class="content">
                    du bist nicht angemeldet.<br>
                    um einen thread erstellen zu können, <a href="{{ url('login') }}">logge</a> dich ein.<br>
                    wenn du keinen account hast, <a href="{{ url('register') }}">registriere</a> dich doch einfach.
                </div>
            </div>
        @endif
    </div>
@endsection