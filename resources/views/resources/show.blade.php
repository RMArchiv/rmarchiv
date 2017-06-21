@extends('layouts.app')
@section('pagetitle', $resource->title)
@section('content')
    <div id="content">
        @if(count($resource) > 0)
            <div id="prodpagecontainer">
                <table id='rmarchivbox_prodmain'>
                    <tr id='prodheader'>
                        <th colspan='3'>
                            <span id='title'><big>{{ $resource->title }}</big></span>
                        </th>
                    </tr>
                    <tr>
                        @if($resource->content_type == 'url')

                        @else
                        <td rowspan='3' id='screenshot'>

                            <img src='{{ asset('storage/'.$resource->content_path) }}' style="max-width: 400px; max-height: 400px"
                                 alt='' title=''/>

                        </td>
                        @endif
                        <td colspan='2'>
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
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul>
                                <li>
                                    <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>&nbsp;{{ $resource->voteup or 0 }}
                                </li>
                                <li>
                                    <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>&nbsp;{{ $resource->votedown or 0 }}
                                </li>
                            </ul>
                        </td>
                        <td id='popularity'>
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
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
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
                        </td>
                        <td id='links'>
                            <ul>
                                    <li>
                                        @if($resource->content_type == 'url')
                                            <h1><a href="{{ $resource->content_path }}">{{ trans('app.website') }}</a>
                                            </h1>
                                        @else
                                            <a href="{{ asset('storage/'.$resource->content_path) }}" download target="_blank">{{ trans('app.download') }}</a>
                                        @endif
                                    </li>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <h2>{{ trans('app.description') }}</h2>
                            {!! $resource->desc_html !!}
                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>{{ trans('app.created_at') }}
                            <time datetime='{{ $resource->created_at }}' title='{{ $resource->created_at }}'>{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</time> {{ trans('app.by') }}
                            <a
                                    href='{{ url('users', $resource->userid) }}' class='user'>{{ $resource->username }}</a>
                            <a href='{{ url('users', $resource->userid) }}' class='usera' title="{{ $resource->username }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $resource->userid }}'
                                        alt="{{ $resource->username }}" class='avatar'/>
                            </a>
                        </td>
                    </tr>
                </table>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('app.popularity_helper') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.use_the_popularity_helper') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                    </div>
                </div>

                @if($comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('app.comments') }}</h2>
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
                                                src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}'
                                                alt="{{ $comment->name }}" class='avatar'/>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
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

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>{{ trans('app.comment_rules') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.comment_rule_1') }}</p>
                        <p>{{ trans('app.comment_rule_2') }}</p>
                        <p>{{ trans('app.comment_rule_3') }}</p>
                        <p>{{ trans('app.comment_rule_4') }}</p>
                    </div>
                </div>

                @permission(('create-game-comments'))
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>{{ trans('app.post_a_reply') }}</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $resource->id) !!}
                    {!! Form::hidden('content_type', 'resource') !!}
                    <div class='content'>
                        @if(CheckRateable::checkRateable('resource', $resource->id, Auth::id()) === true)
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
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                    {!! Form::close() !!}
                </div>
                @else
                    <div class="rmarchivtbl" id="rmarchivbox_prodpost">
                        <h2>{{ trans('app.your_permissions_are_to_low') }}</h2>
                        <div class="content">
                            {{ trans('app.your_permissions_are_to_low_to_post') }}
                        </div>
                    </div>
                    @endpermission
            </div>
        @else
            <h2>{{ trans('app.no_resource_available') }}</h2>
        @endif
    </div>
@endsection