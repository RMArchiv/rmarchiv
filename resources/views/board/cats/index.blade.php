@extends('layouts.app')
@section('content')
    <div id="content">
        @if($threads)
            <h2>{{ $threads->first()->cattitle }}</h2>
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
                    <tr>
                        <td>{{ $thread->threaddate }}</td>
                        <td>
                            <a href='{{ url('users', $thread->usercreateid) }}' class='usera' title="{{ $thread->usercreatename }}">
                                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->usercreateid }}' alt="{{ $thread->usercreatename }}" class='avatar'/>
                            </a> <a href='{{ url('users', $thread->usercreateid) }}' class='user'>{{ $thread->usercreatename }}</a>
                        </td>
                        <td><a href="{{ route('board.cat.show', $thread->catid) }}">{{ $thread->cattitle }}</a></td>
                        <td><a href="{{ route('board.thread.show', $thread->threadid) }}">{{ $thread->threadtitle }}</a></td>
                        <td>{{ $thread->posts }}</td>
                        <td>{{ $thread->lastdate }}</td>
                        <td>
                            <a href='{{ url('users', $thread->userlastid) }}' class='usera' title="{{ $thread->userlastname }}">
                                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->usercreateid }}' alt="{{ $thread->userlastname }}" class='avatar'/>
                            </a> <a href='{{ url('users', $thread->userlastid) }}' class='user'>{{ $thread->userlastname }}</a>
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
                    <input name="category" value="{{ $thread->catid }}" type="hidden" />
                    <div class='content'>
                        <label for='topic'>titel:</label>
                        <input name='topic' id='topic'/>

                        <label for='message'>nachricht:</label>
                        <textarea name='message' id='message'></textarea>
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