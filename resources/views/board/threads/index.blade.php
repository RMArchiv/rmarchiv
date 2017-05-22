@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ $cat->title }}</h1>
                {!! Breadcrumbs::render('forum', $cat) !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
                <ul class="list-group">
                    @foreach($threads as $thread)
                        <li class="list-group-item media" style="margin-top: 0px;">
                            <a class="pull-right" href="{{ route('board.thread.show', $thread->id) }}"><span class="badge">{{ $thread->posts->count() }}</span></a>
                            <a class="pull-left" href="{{ url('users', $thread->user->id) }}"><img class="media-object img-rounded" width="42px" src="http://ava.rmarchiv.de/?size=42&gender=male&id={{ $thread->user->id }}" alt="{{ $thread->user->name }}"></a>
                            <div class="thread-info">
                                <div class="media-heading">
                                    @if($thread->closed == 1)
                                        <i class="fa fa-lock text-danger"></i>
                                    @endif
                                    @if(\App\Models\BoardPoll::whereThreadId($thread->id)->count() != 0)
                                        <i class="fa fa-signal fa-rotate-270"></i>
                                    @endif
                                    <a href="{{ route('board.thread.show', $thread->id) }}">{{ $thread->title }}</a>
                                </div>
                                <div class="media-body" style="font-size: 12px;">
                                    <a href="{{ route('board.cat.show', $cat->id) }}"><span @if(\App\Helpers\DatabaseHelper::isThreadUnread($thread->id) === true) style="font-weight: bold;" @endif>{{ $cat->title }}</span></a>
                                    <span> • </span>
                                    erstellt <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    letzte antwort <time datetime='{{ $thread->last_created_at }}' title='{{ $thread->last_created_at }}'>{{ \Carbon\Carbon::parse($thread->last_created_at)->diffForHumans() }}</time> von <a href='{{ url('users', $thread->last_user->id) }}' class='usera' title="{{ $thread->last_user->name }}">
                                        <img width="16px" class="img-rounded" src='http://ava.rmarchiv.de/?size=16&gender=male&id={{ $thread->last_user->id }}' alt="{{ $thread->last_user->name }}"/>
                                    </a> <a href='{{ url('users', $thread->last_user->id) }}' class='user'>{{ $thread->last_user->name }}</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="panel-footer">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>

        <div class="row">
            @if(Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('board.index.create_thread') }}
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['board.thread.store'], 'id' => 'frmBBSPost']) !!}
                        {!! Form::hidden('cat_id', $cat->id) !!}
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
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('board.threads.index.no_login_title') }}
                    </div>
                    <div class="panel-body">
                        {{ trans('board.threads.index.no_login_title') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection