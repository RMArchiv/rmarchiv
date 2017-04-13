@extends('layouts.app')
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
                                 alt='Titelbild' title='Titelbild'/>

                        </td>
                        @endif
                        <td colspan='2'>
                            <table id='stattable'>
                                <tr>
                                    <td>{{ trans('resources.show.type') }} :</td>
                                    <td>
                                        {{ $resource->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('resources.show.category') }} :</td>
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
                                <li><img src='/assets/rate_up.gif' alt='{{ trans('resources.show.voteup') }}'/>&nbsp;{{ $resource->voteup or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='{{ trans('resources.show.votedown') }}'/>&nbsp;{{ $resource->votedown or 0 }}
                                </li>
                            </ul>
                        </td>
                        <td id='popularity'>
                            @php
                                $perc = \App\Helpers\MiscHelper::getPopularity($resource->commentcount, \App\Helpers\DatabaseHelper::getCommentsMax('resource'));
                            @endphp
                            {{ trans('resources.show.popularity') }}: {{ round($perc, 2) }}%
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
                                    <li><img src='/assets/rate_up.gif' alt='{{ trans('resources.show.voteup') }}'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @elseif($resource->voteup < $resource->votedown)
                                    <li><img src='/assets/rate_down.gif' alt='{{ trans('resources.show.votedown') }}'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @elseif($resource->voteup = $resource->votedown)
                                    <li><img src='/assets/rate_neut.gif' alt='{{ trans('resources.show.voteneut') }}'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @else
                                    <li><img src='/assets/rate_neut.gif' alt='{{ trans('resources.show.voteneut') }}'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @endif
                                {{-- data.cdc > 0
                            <li><img src="/assets/cdc.png" alt="cdcs">cdc's</li>
                             endif
                             --}}
                            </ul>
                            <div id='alltimerank'>{{ trans('resources.show.alltimetop') }}: #0</div>
                        </td>
                        <td id='links'>
                            <ul>
                                    <li>
                                        @if($resource->content_type == 'url')
                                            <h1><a href="{{ $resource->content_path }}">{{ trans('resources.show.linktoppage') }}</a></h1>
                                        @else
                                            <a href="{{ asset('storage/'.$resource->content_path) }}" download target="_blank">{{ trans('resources.show.download') }}</a>
                                        @endif
                                    </li>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <h2>{{ trans('resources.show.description') }}</h2>
                            {!! $resource->desc_html !!}
                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>{{ trans('resources.show.added') }} <time datetime='{{ $resource->created_at }}' title='{{ $resource->created_at }}'>{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</time> {{ trans('resources.show.by') }} <a
                                    href='{{ url('users', $resource->userid) }}' class='user'>{{ $resource->username }}</a>
                            <a href='{{ url('users', $resource->userid) }}' class='usera' title="{{ $resource->username }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $resource->userid }}'
                                        alt="{{ $resource->username }}" class='avatar'/>
                            </a>
                        </td>
                    </tr>
                </table>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('resources.show.popularity_helper_title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('resources.show.popularity_helper_msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                    </div>
                </div>

                @if($comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('resources.show.comments') }}</h2>
                        @foreach($comments as $comment)
                            <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                <div class='content'>
                                    {!! $comment->comment_html !!}
                                </div>
                                <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>{{ trans('resources.show.voteup') }}</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>{{ trans('resources.show.votedown') }}</span>
                                    @endif

                                    <span class='tools' data-cid='{{ $resource->id }}'></span> {{ trans('resources.show.added') }}
                                    {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}'
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
                        <h2>{{ trans('resources.show.comments') }}</h2>
                        <div class="comment">
                            <div class="content">
                                {{ trans('resources.show.no_comments') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>{{ trans('resources.show.comment_rules') }}</h2>
                    <div class='content'>
                        <p>{{ trans('resources.show.comment_tip1') }}</p>
                        <p>{{ trans('resources.show.comment_tip2') }}</p>
                        <p>{{ trans('resources.show.comment_tip3') }}</p>
                        <p>{{ trans('resources.show.comment_tip4') }}</p>
                    </div>
                </div>

                @permission(('create-game-comments'))
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>{{ trans('resources.show.add_comment') }}</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $resource->id) !!}
                    {!! Form::hidden('content_type', 'resource') !!}
                    <div class='content'>
                        @if(CheckRateable::checkRateable('resource', $resource->id, Auth::id()) === true)
                            <div id='prodvote'>
                                {{ trans('resources.show.rate') }}<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up'/>
                                <label for='ratingrulez'>{{ trans('resources.show.voteup') }}</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                <label for='ratingpig'>{{ trans('resources.show.voteneut') }}</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down'/>
                                <label for='ratingsucks'>{{ trans('resources.show.votedown') }}</label>
                            </div>
                        @endif
                        @include('_partials.markdown_editor')
                        <div><a href='/?page=faq#markdown'>{{ trans('resources.show.markdown') }}</a></div>
                    </div>
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                    {!! Form::close() !!}
                </div>
                @else
                    <div class="rmarchivtbl" id="rmarchivbox_prodpost">
                        <h2>{{ trans('resources.show.no_permission') }}</h2>
                        <div class="content">
                            {{ trans('resources.show.no_permission_msg) }}
                        </div>
                    </div>
                    @endpermission
            </div>
        @else
            <h2>{{ trans('resources.show.no_id') }}</h2>
        @endif
    </div>
@endsection