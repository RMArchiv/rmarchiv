@extends('layouts.app')
@section('pagetitle', $cat->title)
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
                            <a class="pull-left" href="{{ url('users', $thread->user->id) }}"><img class="media-object img-rounded" width="42px" src="//{{ config('avatar_path') }}?size=42&gender=male&id={{ $thread->user->id }}" alt="{{ $thread->user->name }}"></a>
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
                                    {{ trans('app.created_at') }}
                                    <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    {{ trans('app.last_reply_at') }}
                                    <time datetime='{{ $thread->last_created_at }}' title='{{ $thread->last_created_at }}'>{{ \Carbon\Carbon::parse($thread->last_created_at)->diffForHumans() }}</time> {{ trans('app.by') }}
                                    <a href='{{ url('users', $thread->last_user->id) }}' class='usera' title="{{ $thread->last_user->name }}">
                                        <img width="16px" class="img-rounded" src='//{{ config('avatar_path') }}?size=16&gender=male&id={{ $thread->last_user->id }}' alt="{{ $thread->last_user->name }}"/>
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
                        {{ trans('app.create_thread') }}
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['board.thread.store'], 'id' => 'frmBBSPost']) !!}
                        {!! Form::hidden('category', $cat->id) !!}
                        <div class='content'>
                            <label for='topic'>{{ trans('app.topic_title') }}:</label>
                            <input name='topic' id='topic'/>

                            <label for='message'>{{ trans('app.message') }}:</label>
                            @include('_partials.markdown_editor')
                            <div><a href='#'>{{ trans('app.markdown_is_usable_here') }}</a></div>
                        </div>
                        <div class='foot'>
                            <input type='submit' value='{{ trans('app.submit') }}' id='submit'></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.login_needed') }}
                    </div>
                    <div class="panel-body">
                        {{ trans('app.login_needed_to_post') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection