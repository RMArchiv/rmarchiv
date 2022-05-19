@extends('layouts.app')
@section('pagetitle', $resource->title)
@section('content')
    @include('resources._partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.resources_overview') }}</h1>
                    {!! Breadcrumbs::render('ressource', $resource) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $resource->title }}
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            @if($resource->content_type == 'url')

                            @else
                                <img src='{{ asset('storage/'.$resource->content_path) }}' style="max-width: 400px; max-height: 400px"
                                         alt='' title=''/>
                            @endif
                            <table id='stattable'>
                                <tr>
                                    <td>{{ trans('app.type') }} :</td>
                                    <td>
                                        {{ $resource->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('app.category') }} :</td>
                                    <td>
                                        {{ $resource->cat }}
                                    </td>
                                </tr>
                            </table>
                                @if($resource->content_type == 'url')
                                    <h1><a href="{{ $resource->content_path }}">{{ trans('app.website') }}</a>
                                    </h1>
                                @else
                                    <h1><a href="{{ asset('storage/'.$resource->content_path) }}" download target="_blank">{{ trans('app.download') }}</a></h1>
                                @endif
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>
                                    <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>&nbsp;{{ $resource->voteup or 0 }}
                                </li>
                                <li>
                                    <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>&nbsp;{{ $resource->votedown or 0 }}
                                </li>
                            </ul>
                            @php
                                $perc = \App\Helpers\MiscHelper::getPopularity($resource->commentcount, \App\Helpers\DatabaseHelper::getCommentsMax('resource'));
                            @endphp
                            {{ trans('app.popularity') }}: {{ round($perc, 2) }}%
                            <br/>
                            <div class='outerbar' title='{{ round($perc, 2) }}%'>
                                <div class='innerbar' style='width: {{ $perc }}%'>&nbsp;<span>{{ $perc }}%</span>
                                </div>
                            </div>
                            <div class='awards'></div>

                            <ul id='avgstats'>
                                @if($resource->voteup > $resource->votedown)
                                    <li>
                                        <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>&nbsp;{{ $resource->voteavg or 0 }}
                                    </li>
                                @elseif($resource->voteup < $resource->votedown)
                                    <li>
                                        <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>&nbsp;{{ $resource->voteavg or 0 }}
                                    </li>
                                @elseif($resource->voteup = $resource->votedown)
                                    <li>
                                        <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>&nbsp;{{ $resource->voteavg or 0 }}
                                    </li>
                                @else
                                    <li>
                                        <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>&nbsp;{{ $resource->voteavg or 0 }}
                                    </li>
                                @endif
                                {{-- data.cdc > 0
                            <li><img src="/assets/cdc.png" alt="cdcs">cdc's</li>
                             endif
                             --}}
                            </ul>
                            <div id='alltimerank'>{{ trans('app.alltime_top') }}: #0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.description') }}
                    </div>
                    <div class="card-body">
                        {!! $resource->desc_html !!}
                    </div>
                    <div class="card-footer">{{ trans('app.created_at') }}
                        <time datetime='{{ $resource->created_at }}' title='{{ $resource->created_at }}'>{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</time> {{ trans('app.by') }}
                        <a
                                href='{{ url('users', $resource->userid) }}' class='user'>{{ $resource->username }}</a>
                        <a href='{{ url('users', $resource->userid) }}' class='usera' title="{{ $resource->username }}"><img
                                    src='//{{ config('app.avatar_path') }}?gender=male&id={{ $resource->userid }}'
                                    alt="{{ $resource->username }}" class='avatar' width="16px"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.popularity_helper') }}
                    </div>
                    <div class="card-body">
                        <p>{{ trans('app.use_the_popularity_helper') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.comments') }}
                    </div>
                    <div class="card-body">
                        @if($comments->count() > 0)
                            @foreach($comments as $comment)
                                <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                    <div class='content'>
                                        {!! $comment->comment_html !!}
                                    </div>
                                    <div class='foot'>
                                        @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                            <span class='vote up'>{{ trans('app.rate_up') }}</span>
                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                            <span class='vote down'>{{ trans('app.rate_down') }}</span>
                                        @endif

                                        <span class='tools' data-cid='{{ $resource->id }}'></span> {{ trans('app.posted_at') }}
                                        {{ $comment->created_at }} {{ trans('app.by') }}
                                        <a href='{{ url('user', $comment->user_id) }}'
                                           class='user'>{{ $comment->name }}</a>
                                        <a href='{{ url('users', $comment->user_id) }}' class='usera'
                                           title="{{ $comment->name }}"><img
                                                    src='//{{ config('app.avatar_path') }}?gender=male&id={{ $comment->user_id }}'
                                                    alt="{{ $comment->name }}" class='avatar'/>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                                <h2>{{ trans('app.comments') }}</h2>
                                <div class="comment">
                                    <div class="content">
                                        {{ trans('app.no_comments_available') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.comment_rules') }}
                    </div>
                    <div class="card-body">
                        <p>{{ trans('app.comment_rule_1') }}</p>
                        <p>{{ trans('app.comment_rule_2') }}</p>
                        <p>{{ trans('app.comment_rule_3') }}</p>
                        <p>{{ trans('app.comment_rule_4') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::check())
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['action' => ['CommentController@add']]) !!}
                {!! Form::hidden('content_id', $resource->id) !!}
                {!! Form::hidden('content_type', 'resource') !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.post_a_reply') }}
                    </div>
                    <div class="card-body">
                        <div class='content'>
                            @if(\App\Helpers\CheckRateableHelper::checkRateable('resource', $resource->id, Auth::id()) === true)
                                <div id='prodvote'>
                                    {{ trans('app.rate_this_resource') }}<br>
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
                    </div>
                    <div class="card-footer">
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @endif
    </div>

@endsection