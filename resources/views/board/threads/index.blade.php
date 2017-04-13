@extends('layouts.app')
@section('content')
    <div id="content">
        <h2>
            {{ $cat->title }}
        </h2>
        @if($threads)
            <table id="rmarchivbox_bbslist" class="boxtable pagedtable">
                <thead>
                <tr>
                    <th id='th_firstpost'>{{ trans('board.threads.index.created_at') }}</th>
                    <th id='th_userfirstpost'>{{ trans('board.threads.index.created_by') }}</th>
                    <th id='th_category'>{{ trans('board.threads.index.category') }}</th>
                    <th id='th_topic'>{{ trans('board.threads.index.topic') }}</th>
                    <th id='th_count'>{{ trans('board.index.postcount') }}</th>
                    <th id='th_lastpost'>{{ trans('board.threads.index.lastpost_at') }}</th>
                    <th id='th_userlastpost'>{{ trans('board.threads.index.lastpost_by') }}</th>
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
                                @if(\App\Models\BoardPoll::whereThreadId($thread->id)->count() != 0)
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
            <h2>{{ trans('board.threads.index.no_threads_head') }}</h2>
        @endif

        @if(Auth::check())
            <div class='rmarchivtbl' id='rmarchivbox_bbsopen'>
                <h2>{{ trans('board.threads.index.create_thread') }}</h2>
                {!! Form::open(['route' => ['board.thread.store']]) !!}
                <input name="category" value="{{ $cat->id }}" type="hidden" />
                <div class='content'>
                    <label for='topic'>{{ trans('board.threads.index.topic_title') }}:</label>
                    <input name='topic' id='topic'/>

                    <label for='message'>{{ trans('board.threads.index.message') }}:</label>
                    @include('_partials.markdown_editor')
                    <div><a href='#'>{{ trans('board.threads.index.markdown') }}</a></div>
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' id='submit'></div>
                {!! Form::close() !!}
            </div>
        @else
            <div class="rmarchivtbl" id="rmarchivbox_bbsopen">
                <h2>{{ trans('board.threads.index.no_login_title') }}</h2>
                <div class="content">
                    {{ trans('board.threads.index.no_login_msg') }}
                </div>
            </div>
        @endif
    </div>
@endsection