@extends('layouts.app')
@section('pagetitle', trans('app.user').': '.$user->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.user') }}: {{ $user->name }}</h1>
                {!! Breadcrumbs::render('user', $user) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.user_informations') }}
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img class="img-responsive img-rounded"
                                 width="160px"
                                 src="http://ava.rmarchiv.de/?size=160&gender=male&id={{ $user->id }}"
                                 alt="User Pic">
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-muted">{{ trans('app.username') }}: </span>{{ $user->name }}</p>
                            <p>
                                <span class="text-muted">{{ trans('app.registered_since') }}: </span>{{ $user->created_at }}
                            </p>
                            <p>
                                <span class="text-muted">{{ trans('app.userlevel') }}: </span>{{ $user->roles[0]->display_name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.obyx_overview') }}
                        <div class="pull-right">
                            <span class="badge">OBYX PLATZHALTER</span>
                        </div>
                    </div>
                    <ul class="list-group">
                        @foreach($user->userobyx()->groupBy('obyx_id')->get() as $ob)

                            <li class="list-group-item">
                                <span class="badge">
                                    @php
                                        $count = $user->userobyx()->where('obyx_id', '=', $ob->obyx_id)->count();
                                        $sum = $ob->obyx->value * $count;
                                    @endphp
                                    {{ $sum }}
                                    </span>
                                {{ trans('app.obyx.'.$ob->obyx->reason) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.latest_added_games') }}
                    </div>
                    <ul class="list-group">
                        @foreach($user->games()->orderBy('created_at', 'desc')->limit(5)->get() as $g)
                            <li class="list-group-item">
                                <span class='rowprod'>
                                    <span class='prodentry'>
                                        @if(isset($g->gamefiles[0]))
                                            <span class='typeiconlist'>
                                                <span class='typei type_{{ $g->gamefiles[0]->gamefiletype->short }}'
                                                      title='{{ $g->gamefiles[0]->gamefiletype->title }}'>{{ $g->gamefiles[0]->gamefiletype->title }}</span>
                                            </span>
                                        @endif
                                        <span class="platformiconlist">
                                            <a href="{{ route('maker.show', $g->maker->id) }}">
                                                <span class="typei type_{{ $g->maker->short }}" title="{{ $g->maker->title }}">
                                                    {{ $g->maker->title }}
                                                </span>
                                            </a>
                                        </span>
                                        <span class='prod'>
                                            <a href='{{ url('games',$g->id) }}'>{{ $g->title }}
                                                @if($g->subtitle != '')
                                                    <small> - {{ $g->subtitle }}</small>
                                                @endif
                                            </a>
                                            <span><img src="/assets/lng/16/{{ strtoupper($g->language->short) }}.png"
                                                       title="{{ $g->langname }}"></span>
                                        </span>
                                            <br>
                                        <span class='group'>
                                            {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->id) !!}
                                        </span>
                                        <span class="pull-right">
                                            {{ trans('app.created_at') }}: {{ \Carbon\Carbon::parse($g->created_at)->diffForHumans() }}
                                        </span>
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.latest_added_developers') }}
                    </div>
                    <ul class="list-group">
                        @foreach($user->developers()->orderBy('created_at', 'desc')->limit(8)->get() as $dev)
                            <li class="list-group-item">
                                <div class="pull-right">
                                    {{ trans('app.created_at') }}: {{ \Carbon\Carbon::parse($dev->created_at)->diffForHumans() }}
                                </div>
                                <a href="{{ action('DeveloperController@show', $dev->id) }}">{{ $dev->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.last_shoutbox_posts') }}
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            @foreach($user->shoutbox()->orderBy('created_at', 'desc')->limit(5)->get() as $comment)
                                <div class="media">
                                    <div class="media-left">
                                        <a href='{{ url('users', $comment->user_id) }}'
                                           title="{{ $comment->user->name }}">
                                            <img
                                                    width="32px"
                                                    src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}'
                                                    alt="{{ $comment->user->name }}" class='media img-rounded'/>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <a href='{{ url('users', $comment->user_id) }}' title="{{ $comment->user->name }}">{{ $comment->user->name }}</a> -
                                            {{ trans('app.posted_at') }} {{ $comment->created_at }}<br>
                                            {!! $comment->shout_html !!}
                                        </div>
                                        <a href='{{ url('user', $comment->user_id) }}'
                                           class='user'>{{ $comment->name }}</a>
                                        {!! \App\Helpers\InlineBoxHelper::GameBox($comment->comment_html) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.last_comments') }}
                    </div>
                    <div class="panel-body">
                        @foreach($user->comments()->orderBy('created_at', 'desc')->limit(5)->get() as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <a href='{{ url('users', $comment->user_id) }}'
                                       title="{{ $comment->user->name }}">
                                        <img
                                                width="32px"
                                                src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}'
                                                alt="{{ $comment->user->name }}" class='media img-rounded'/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href='{{ url('users', $comment->user_id) }}' title="{{ $comment->user->name }}">{{ $comment->user->name }}</a> -
                                        {{ trans('app.posted_at') }} {{ $comment->created_at }}<br>
                                        <span class="text-muted">
                                            @if($comment->content_type == 'game')
                                                {{ trans('app.game') }}:
                                                <a href="{{ action('GameController@show', $comment->game()->first()->id) }}">{{ $comment->game()->first()->title }}</a>
                                            @elseif($comment->content_type == 'news')
                                                {{ trans('app.news') }}:
                                                <a href="{{ action('NewsController@show', $comment->news()->first()->id) }}">{{ $comment->news()->first()->title }}</a>
                                            @endif
                                        </span>
                                        @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                            <span class='vote up'>{{ trans('app.rate_up') }}</span>
                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                            <span class='vote down'>{{ trans('app.rate_down') }}</span>
                                        @endif
                                    </div>
                                    <a href='{{ url('user', $comment->user_id) }}'
                                       class='user'>{{ $comment->name }}</a>
                                    {!! \App\Helpers\InlineBoxHelper::GameBox($comment->comment_html) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection