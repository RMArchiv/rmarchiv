@extends('layouts.app')
@section('pagetitle', 'forum übersicht')
@section('content')
    <div id='content'>
        <h1>{{ trans('app.board.index.title') }}</h1>
        @foreach($cats as $cat)
            <h2><a href="{{ url('board/cat', $cat->id) }}">{{ $cat->title }}</a></h2>
            <table id="rmarchivbox_bbslist" class="boxtable pagedtable" width="80%">
                <thead>
                    <tr>
                        <th id='th_firstpost'>{{ trans('app.board.table.create_date') }}</th>
                        <th id='th_userfirstpost'>{{ trans('app.board.table.firstpostuser') }}</th>
                        <th id='th_category'>{{ trans('app.board.table.category') }}</th>
                        <th id='th_topic'>{{ trans('app.board.table.topic') }}</th>
                        <th id='th_count'>{{ trans('app.board.table.postcount') }}</th>
                        <th id='th_lastpost'>{{ trans('app.board.table.lastpostdate') }}</th>
                        <th id='th_userlastpost'>{{ trans('app.board.table.lastpostuser') }}</th>
                    </tr>
                </thead>

                @foreach($cat->threads->sortByDesc('last_created_at')->take(15) as $thread)
                <tr @if(\App\Helpers\DatabaseHelper::isThreadUnread($thread->id) === true) style="font-weight: bold;" @endif>
                    <td>
                        <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                    </td>
                    <td>
                        <a href='{{ url('users', $thread->user->id) }}' class='usera' title="{{ $thread->user->name }}">
                            <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->user->id }}' alt="{{ $thread->user->name }}" class='avatar'/>
                        </a> <a href='{{ url('users', $thread->user->id) }}' class='user'>{{ $thread->user->name }}</a>
                    </td>
                    <td><a href="{{ route('board.cat.show', $cat->id) }}">{{ $cat->title }}</a></td>
                    <td>
                        <a href="{{ route('board.thread.show', $thread->id) }}">
                            @if($thread->closed == 1)
                                <img src="/assets/lock.png">
                            @endif
                            @if(\App\Models\BoardPoll::whereThreadId($thread->id)->count() != 0)
                                <img src="/assets/stats.gif">
                            @endif
                            {{ $thread->title }}</a>
                    </td>
                    <td>{{ $thread->posts->count() }}</td>
                    <td><time datetime='{{ $thread->last_created_at }}' title='{{ $thread->last_created_at }}'>{{ \Carbon\Carbon::parse($thread->last_created_at)->diffForHumans() }}</time></td>
                    <td>
                        <a href='{{ url('users', $thread->last_user->id) }}' class='usera' title="{{ $thread->last_user->name }}">
                            <img src='http://ava.rmarchiv.de/?gender=male&id={{ $thread->last_user->id }}' alt="{{ $thread->last_user->name }}" class='avatar'/>
                        </a> <a href='{{ url('users', $thread->last_user->id) }}' class='user'>{{ $thread->last_user->name }}</a>
                    </td>
                </tr>
                @endforeach
            </table>
        @endforeach

    </div>

    @if(Auth::check())
    <div class='rmarchivtbl' id='rmarchivbox_bbsopen'>
        <h2>{{ trans('app.board.index.create') }}</h2>
        {!! Form::open(['route' => ['board.thread.store']]) !!}
            <div class='content'>
                <label for='topic'>{{ trans('app.board.index.create_title') }}</label>
                <input name='topic' id='topic'/>
                <label for='category'>{{ trans('app.board.index.create_category') }}</label>
                <select name='category' id='category'>
                    @foreach($cats as $cat)
                    <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                    @endforeach
                </select>
                <label for='message'>{{ trans('app.board.index.message') }}</label>
                @include('_partials.markdown_editor')
                <div>{!! trans('editor.markdown_possible') !!}</div>
            </div>
            <div class='foot'>
                <input type='submit' value='{{ trans('app.board.index.send') }}' id='submit'></div>
        {!! Form::close() !!}
    </div>
    @else
    <div class="rmarchivtbl" id="rmarchivbox_bbsopen">
        <h2>{{ trans('app.board.no_login.title') }}</h2>
        <div class="content">
            {!! trans('app.board.no_login.msg') !!}
        </div>
    </div>
    @endif
@endsection