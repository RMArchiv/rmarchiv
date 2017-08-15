@extends('layouts.app')
@section('pagetitle', trans('app.news').': '.$news->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <div class="btn-toolbar pull-right">
                    <div class="btn-group">
                        @if(Auth::check())
                            @if(Auth::user()->settings->is_admin)
                                <a class="btn btn-primary" href="javascript:void(0);" onclick="$(this).find('form').submit();">
                                    <form action="{{ url('/news', $news->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <span class="fa fa-trash"></span>
                                </a>
                            @endif
                            @permission(('edit-news'))
                            @if($news->approved == 1)
                                <a class="btn btn-primary" href="{{ url('news/'.$news->id.'/approve/0') }}"><span class="fa fa-minus"></span></a>
                            @else
                                <a class="btn btn-primary" href="{{ url('news/'.$news->id.'/approve/1') }}"><span class="fa fa-plus"></span></a>
                            @endif
                            @endpermission
                            @permission(('edit-news'))
                            <a class="btn btn-primary" href="{{ action('NewsController@edit', $news->id) }}"><span class="fa fa-edit"></span></a>
                            @endpermission
                        @endif
                    </div>
                </div>
                <h1>{{ trans('app.news').': '.$news->title }}</h1>
                {!! Breadcrumbs::render('news.show', $news) !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $news->title }}</div>
                <div class="panel-body">{!! \App\Helpers\InlineBoxHelper::GameBox($news->news_html) !!}</div>
                <div class="panel-footer">
                    {{ trans('app.submitted_by') }}
                    <a href='{{ url('users', $news->user_id) }}'>{{ $news->name }}</a> ::
                    <time datetime='{{ $news->created_at }}' title='{{ $news->created_at }}'>{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</time>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.popularity_helper') }}</div>
                <div class="panel-body">
                    <p>{{ trans('app.use_the_popularity_helper') }}</p>
                    <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                </div>
            </div>
        </div>
        @if($news->comments()->count() > 0)
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('app.comments') }}</div>
                    <div class="panel-body">
                        @foreach($news->comments()->get() as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <a href='{{ url('users', $comment->user_id) }}'
                                       title="{{ $comment->user->name }}">
                                        <img
                                                width="32px"
                                                src='//{{ config('avatar_path') }}?gender=male&id={{ $comment->user_id }}'
                                                alt="{{ $comment->user->name }}" class='media img-rounded'/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href='{{ url('users', $comment->user_id) }}' title="{{ $comment->user->name }}">{{ $comment->user->name }}</a> -
                                        {{ trans('app.posted_at') }} {{ $comment->created_at }}
                                        @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                            <span class='vote up'>up</span>
                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                            <span class='vote down'>down</span>
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
        @else
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('app.comments') }}</div>
                    <div class="panel-body">
                        {{ trans('app.no_comments_available') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.comment_rules') }}</div>
                <div class="panel-body">
                    <p>{{ trans('app.comment_rule_1') }}</p>
                    <p>{{ trans('app.comment_rule_2') }}</p>
                    <p>{{ trans('app.comment_rule_3') }}</p>
                    <p>{{ trans('app.comment_rule_4') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.add_comment') }}</div>
                <div class="panel-body">
                    @permission(('create-game-comments'))
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $news->id) !!}
                    {!! Form::hidden('content_type', 'news') !!}
                    <div class='content'>
                        @if(\App\Helpers\CheckRateableHelper::checkRateable('news', $news->gameid, Auth::id()) === true)
                            <div id='prodvote'>
                                {{ trans('app.rate_this_news') }}<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up'/>
                                <label for='ratingrulez'>{{ trans('app.rate_up') }}</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                <label for='ratingpig'>{{ trans('app.rate_neut') }}</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down'/>
                                <label for='ratingsucks'>{{ trans('app.rate_down') }}</label>
                            </div>
                        @endif

                        @include('_partials.markdown_editor')

                        <div><a href='/?page=faq#markdown'>{{ trans('app.markdown_is_usable_here') }}</a></div>
                    </div>
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                    {!! Form::close() !!}
                    @else
                        {{ trans('app.your_permissions_are_to_low') }}
                        @endpermission
                </div>
            </div>
        </div>
    </div>
@endsection