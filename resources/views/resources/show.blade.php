@extends('layouts.app')
@section('pagetitle', $resource->title)
@section('content')
    @include('resources._partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.resources_overview') }}</h1>
                    {{ Breadcrumbs::render('ressource', $resource) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $resource->title }}
                    </div>
                    <div class="card-body d-md-flex gap-4">
                        <div class="col-md-6">
                            @if ($resource->content_type == 'url')
                            @else
                                <img src='{{ asset('storage/' . $resource->content_path) }}'
                                    style="max-width: 400px; max-height: 400px" alt='' title='' />
                            @endif
                            <table class="gap-4 mt-2" id='table'>
                                <tr>
                                    <td class="bg-primary border-end border-bottom px-2"><i class="fa fa-shapes"></i>
                                        {{ trans('app.type') }}
                                    </td>
                                    <td class="border-bottom px-2">
                                        {{ $resource->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-primary border-end px-2"><i class="fa fa-folder-tree"></i>
                                        {{ trans('app.category') }}
                                    </td>
                                    <td class="px-2">
                                        {{ $resource->cat }}
                                    </td>
                                </tr>
                            </table>
                            @if ($resource->content_type == 'url')
                                <a class="btn btn-secondary text-warning btn-lg my-4 w-75"
                                    href="{{ $resource->content_path }}">{{ trans('app.website') }}</a>
                            @else
                                <a class="btn btn-secondary text-warning btn-lg my-4 w-75"
                                    href="{{ asset('storage/' . $resource->content_path) }}" download
                                    target="_blank">{{ trans('app.download') }}</a>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    {{ trans('app.statistics.title') }}
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        @php
                                            $perc = \App\Helpers\MiscHelper::getPopularity(
                                                $resource->commentcount,
                                                \App\Helpers\DatabaseHelper::getCommentsMax('resource'),
                                            );
                                        @endphp
                                        <i class="fa fa-arrow-trend-up"></i>
                                        {{ trans('app.popularity') }}: {{ number_format($perc, 2) }}% </br>
                                        <x-common.progressbar :percent="$perc" />
                                        {{-- //TODO no data yet <i class="fa fa-eye"></i>
                                        {{ trans('app.profile_views') }}: {{ number_format($resource->views ?? 0, 0, ',', '.') }} --}}
                                    </li>
                                    <li class="list-group-item clearfix">
                                        <ul class="list-unstyled">
                                            <li>
                                                <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}' />
                                                {{ $resource->voteup ?? 0 }}
                                            </li>
                                            <li>
                                                <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}' />
                                                {{ $resource->votedown ?? 0 }}
                                            </li>
                                        </ul>
                                        <ul class="list-unstyled">
                                            <li>
                                                @if ($resource->voteup > $resource->votedown)
                                                    <img src='/assets/rate_up.gif' alt='good' />
                                                @elseif($resource->voteup < $resource->votedown)
                                                    <img src='/assets/rate_down.gif' alt='bad' />
                                                @elseif($resource->voteup == $resource->votedown)
                                                    <img src='/assets/rate_neut.gif' alt='ok' />
                                                @else
                                                    <img src='/assets/rate_neut.gif' alt='ok' />
                                                @endif
                                                <span>{{ $resource->avg ?? 0 }}</span>
                                            </li>
                                            {{-- //TODO <li>{{ trans('app.alltime_top') }}: #0</li> --}}
                                        </ul>
                                    </li>
                                </ul>
                            </div>
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
                        <time datetime='{{ $resource->created_at }}'
                            title='{{ $resource->created_at }}'>{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</time>
                        {{ trans('app.by') }}
                        <a href='{{ url('users', $resource->userid) }}' class='user'>{{ $resource->username }}</a>
                        <a href='{{ url('users', $resource->userid) }}' class='usera'
                            title="{{ $resource->username }}"><img
                                src='//{{ config('app.avatar_path') }}?gender=male&id={{ $resource->userid }}'
                                alt="{{ $resource->username }}" class='avatar' width="16px" />
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
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
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
                        @if ($comments->count() > 0)
                            @foreach ($comments as $comment)
                                <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                    <div class='content'>
                                        {!! $comment->comment_html !!}
                                    </div>
                                    <div class='foot'>
                                        @if ($comment->vote_up == 1 and $comment->vote_down == 0)
                                            <span class='vote up'>{{ trans('app.rate_up') }}</span>
                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                            <span class='vote down'>{{ trans('app.rate_down') }}</span>
                                        @endif

                                        <span class='tools' data-cid='{{ $resource->id }}'></span>
                                        {{ trans('app.posted_at') }}
                                        {{ $comment->created_at }} {{ trans('app.by') }}
                                        @include('reports._partials.report-button', [
                                            'reportType' => 'comment',
                                            'reportId' => $comment->id,
                                            'reportLabel' => $resource->title,
                                        ])
                                        <a href='{{ url('user', $comment->user_id) }}'
                                            class='user'>{{ $comment->name }}</a>
                                        <a href='{{ url('users', $comment->user_id) }}' class='usera'
                                            title="{{ $comment->name }}"><img
                                                src='//{{ config('app.avatar_path') }}?gender=male&id={{ $comment->user_id }}'
                                                alt="{{ $comment->name }}" class='avatar' />
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
        @if (Auth::check())
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ action('CommentController@add') }}">
                        @csrf
                        <input type="hidden" name="content_id" value="{{ $resource->id }}">
                        <input type="hidden" name="content_type" value="resource">
                        <div class="card">
                            <div class="card-header">
                                {{ trans('app.post_a_reply') }}
                            </div>
                            <div class="card-body">
                                <div class='content'>
                                    @if (\App\Helpers\CheckRateableHelper::checkRateable('resource', $resource->id, Auth::id()) === true)
                                        <div id='prodvote'>
                                            {{ trans('app.rate_this_resource') }}<br>
                                            <input type='radio' name='rating' id='ratingrulez' value='up' />
                                            <label for='ratingrulez'>{{ trans('app.rate_up') }}</label>
                                            <input type='radio' name='rating' id='ratingpig' value='neut'
                                                checked='checked' />
                                            <label for='ratingpig'>{{ trans('app.rate_neut') }}</label>
                                            <input type='radio' name='rating' id='ratingsucks' value='down' />
                                            <label for='ratingsucks'>{{ trans('app.rate_down') }}</label>
                                        </div>
                                    @endif
                                    @include('_partials.markdown_editor')
                                    <div><a href='/?page=faq#markdown'>{{ trans('app.markdown_is_usable_here') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id='submit'>{{ trans('app.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection
