@extends('layouts.app')
@section('pagetitle', $posts->first()->thread->title)
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_bbsview'>
            <h2>{{ $posts->first()->thread->title }}
                @permission(('mod-threads'))
                    @if($posts->first()->thread->closed == 0)
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 1]) }}">{{ trans('board.threads.show.close') }}</a>
                    @else
                        :: <a href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 0]) }}">{{ trans('board.threads.show.open') }}</a>
                    @endif
                @endpermission
            </h2>
            <div class='threadcategory'><b>{{ trans('board.threads.show.category') }}:</b> <a href="{{ url('board/cat', $posts->first()->cat->id) }}">{{ $posts->first()->cat->title }}</a>
            </div>
            <div class="threadcategory">
                @if(Auth::check())
                    @if(Auth::id() == $posts->first()->thread->user_id or Auth::user()->can('mod-threads'))
                        @if(!$poll)
                            <a href="{{ route('board.vote.create', ['threadid' => $posts->first()->thread_id])}}">{{ trans('board.threads.show.create_poll') }}</a>
                        @endif
                    @endif
                @endif

                @if($poll)
                        <h2>{{ $poll->title }}</h2>
                    <div class="content" style="text-align: center">
                        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
                            <thead>
                                <th width="50%">{{ trans('board.threads.show.answer') }}</th>
                                <th width="10%">{{ trans('board.threads.show.votes') }}</th>
                                <th width="30%"> </th>
                                <th width="">{{ trans('board.threads.show.action') }}</th>
                            </thead>
                            @foreach($answers as $ans)
                                @if($ans->title != '')
                                    <tr>
                                        <td>
                                            @if($votes)
                                                @if($votes->count() != 0 and $votes->first()->answer_id == $ans->id)
                                                    <b>{{ $ans->title }}</b>
                                                @else
                                                    {{ $ans->title }}
                                                @endif
                                            @else
                                                {{ $ans->title }}
                                            @endif
                                        </td>
                                        <td>{{ $ans->votes->count() }}</td>
                                        <td><div class="innerbar_solo" style="width: {{ \App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount) }}%;"></div></td>
                                        <td>
                                        @if(Auth::check())
                                            {!! Form::open(['action' => ['BoardController@add_vote'], 'method' => 'POST']) !!}
                                            {!! Form::hidden('poll_id', $poll->id) !!}
                                            {!! Form::hidden('answer_id', $ans->id) !!}
                                            {!! Form::hidden('thread_id', $posts->first()->thread_id) !!}
                                                <input type='submit' value='Submit' id='submit'>
                                            {!! Form::close() !!}
                                        @else
                                            <a href="{{ action('Auth\LoginController@showLoginForm') }}">
                                                {{ trans('board.threads.show.loginto_vote') }}
                                            </a>
                                        @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
            {{ $posts->links('vendor/pagination/board_thread') }}
            @foreach($posts as $post)
                <div class='content cite-{{ $post->thread->id  }} markdown' id='c{{ $post->id }}'>
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
                        {{ trans('board.threads.show.posts') }}: {{ $post->user->boardposts->count() }}
                    </div>
                    <div class="post markdown">
                        {!! \App\Helpers\InlineBoxHelper::GameBox($post->content_html) !!}
                    </div>
                </div>
                <div class='foot'>
                    @if(Auth::check())
                        @if(Auth::id() == $post->user->id or Auth::user()->can('mod-threads'))
                        <span data-cid='{{ $post->id }}'>
                            [<a href="{{ route('board.post.edit', [$post->thread->id, $post->id]) }}" data-rel="popup">{{ trans('board.threads.show.edit') }}</a>]
                        </span>
                        @endif
                    @endif
                        {{ trans('board.threads.show.posted') }}
                    <a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}'><time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time></a>
                    @if($post->updated_at)
                        - {{ trans('board.threads.show.edited') }} {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                    @endif
                </div>
            @endforeach
            {{ $posts->links('vendor/pagination/board_thread') }}
        </div>

        @if(Auth::check())
        <div class='rmarchivtbl' id='rmarchivbox_bbspost'>
            @if($post->thread->closed == 0)
                <h2>{{ trans('board.threads.show.create_post') }}</h2>
                {!! Form::open(['action' => ['BoardController@store_post', $posts->first()->thread->id], 'id' => 'frmBBSPost']) !!}
                    <input type='hidden' name='catid' value='{{ $posts->first()->cat->id }}'>
                    <div class='content'>
                        @include('_partials.markdown_editor')
                        <div><a href='#'>{{ trans('board.threads.show.markdown') }}</a></div>
                    </div>
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'></div>
                {!! Form::close() !!}
            @else
                <h2>{{ trans('board.threads.show.thread_closed') }}</h2>
                <div class="content">
                    {{ trans('board.threads.show.thread_closed_msg') }}
                </div>
            @endif
        </div>
        @else
        <div class="rmarchivtbl">
            <h2>{{ trans('board.threads.show.no_login_title') }}</h2>
            <div class="content">
                {{ trans('board.threads.show.no_login_msg') }}
            </div>
        </div>
        @endif
    </div>
@endsection