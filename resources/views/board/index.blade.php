@extends('layouts.app')
@section('content')
    <div id='content'>
        <h1>das rmarchiv forum</h1>
        @foreach($cats as $cat)
            <h2>{{ $cat->title }}</h2>
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

                @foreach($threads[$cat->id] as $thread)
                <tr>
                    <td>{{ $thread->threaddate }}</td>
                    <td>
                        <a href='{{ url('users', $thread->usercreateid) }}' class='usera' title="{{ $thread->usercreatename }}">
                            <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->usercreateid }}' alt="{{ $thread->usercreatename }}" class='avatar'/>
                        </a> <a href='{{ url('users', $thread->usercreateid) }}' class='user'>{{ $thread->usercreatename }}</a>
                    </td>
                    <td><a href="{{ route('board.cat.show', $cat->id) }}">{{ $cat->title }}</a></td>
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
        @endforeach

    </div>

    @if(Auth::check())
    <div class='rmarchivtbl' id='rmarchivbox_bbsopen'>
        <h2>erstelle einen neuen thread</h2>
        {!! Form::open(['route' => ['board.thread.store']]) !!}
            <div class='content'>
                <label for='topic'>titel:</label>
                <input name='topic' id='topic'/>
                <label for='category'>kategorie:</label>
                <select name='category' id='category'>
                    @foreach($cats as $cat)
                    <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                    @endforeach
                </select>
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
@endsection