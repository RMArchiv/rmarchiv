@extends('layouts.app')
@section('content')
    <div id="content">
        @if($threads)
            <table id="rmarchivbox_bbslist" class="boxtable pagedtable">
                <thead>
                <tr>
                    <th id='th_unread'>ungelesen</th>
                    <th id='th_firstpost'>gestartet</th>
                    <th id='th_topic'>thema</th>
                    <th id='th_count'>beteiligte</th>
                    <th id='th_lastpost'>letzter post</th>
                    <th id='th_userlastpost'>von</th>
                </tr>
                </thead>

                @foreach($threads as $thread)

                    <tr>
                        <td>
                            @if($thread->isUnread($currentUserId))
                                NEU!
                            @endif
                        </td>
                        <td>{{ $thread->created_at }}</td>
                        <td>{!! link_to('messages/' . $thread->id, $thread->subject) !!}</td>
                        <td>{{ $thread->participantsString(Auth::id()) }}</td>
                        <td>{{ $thread->updated_at }}</td>
                        <td>
                            <a href='{{ url('users', $thread->creator()->id) }}' class='usera' title="{{ $thread->creator()->name }}">
                                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->creator()->id }}' alt="{{ $thread->creator()->name }}" class='avatar'/>
                            </a> <a href='{{ url('users', $thread->creator()->id) }}' class='user'>{{ $thread->creator()->name }}</a>
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