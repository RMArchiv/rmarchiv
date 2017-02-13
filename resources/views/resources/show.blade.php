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
                                    <td>typ :</td>
                                    <td>
                                        {{ $resource->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>kategorie :</td>
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
                                <li><img src='/assets/rate_up.gif' alt='super'/>&nbsp;{{ $resource->voteup or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='scheiße'/>&nbsp;{{ $resource->votedown or 0 }}
                                </li>
                            </ul>
                        </td>
                        <td id='popularity'>
                            @php
                                $perc = \App\Helpers\MiscHelper::getPopularity($resource->commentcount, \App\Helpers\DatabaseHelper::getCommentsMax('resource'));
                            @endphp
                            popularität: {{ round($perc, 2) }}%
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
                                    <li><img src='/assets/rate_up.gif' alt='ok'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @elseif($resource->voteup < $resource->votedown)
                                    <li><img src='/assets/rate_down.gif' alt='ok'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @elseif($resource->voteup = $resource->votedown)
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @else
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $resource->voteavg or 0 }}</li>
                                @endif
                                {{-- data.cdc > 0
                            <li><img src="/assets/cdc.png" alt="cdcs">cdc's</li>
                             endif
                             --}}
                            </ul>
                            <div id='alltimerank'>alltime top: #0</div>
                        </td>
                        <td id='links'>
                            <ul>
                                    <li>
                                        @if($resource->content_type == 'url')
                                            <h1><a href="{{ $resource->content_path }}">Link zur Seite</a></h1>
                                        @else
                                            <a href="{{ asset('storage/'.$resource->content_path) }}" download target="_blank">download</a>
                                        @endif
                                    </li>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <h2>beschreibung</h2>
                            {!! $resource->desc_html !!}
                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>hinzugefügt <time datetime='{{ $resource->created_at }}' title='{{ $resource->created_at }}'>{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</time> von <a
                                    href='{{ url('users', $resource->userid) }}' class='user'>{{ $resource->username }}</a>
                            <a href='{{ url('users', $resource->userid) }}' class='usera' title="{{ $resource->username }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $resource->userid }}'
                                        alt="{{ $resource->username }}" class='avatar'/>
                            </a>
                        </td>
                    </tr>
                </table>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('app.news.popularity_helper.title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.news.popularity_helper.msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                    </div>
                </div>

                @if($comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        @foreach($comments as $comment)
                            <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                <div class='content'>
                                    {!! $comment->comment_html !!}
                                </div>
                                <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>up</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>down</span>
                                    @endif

                                    <span class='tools' data-cid='{{ $resource->id }}'></span> hinzugefügt
                                    am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}'
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
                        <h2>kommentare</h2>
                        <div class="comment">
                            <div class="content">
                                Es sind noch keine Kommentare vorhanden.
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>kommentarhinweise</h2>
                    <div class='content'>
                        <p>{{ trans('app.comments.tip1') }}</p>
                        <p>{{ trans('app.comments.tip2') }}</p>
                        <p>{{ trans('app.comments.tip3') }}</p>
                        <p>{{ trans('app.comments.tip4') }}</p>
                    </div>
                </div>

                @permission(('create-game-comments'))
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>kommentar hinzufügen</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $resource->id) !!}
                    {!! Form::hidden('content_type', 'resource') !!}
                    <div class='content'>
                        @if(CheckRateable::checkRateable('resource', $resource->id, Auth::id()) === true)
                            <div id='prodvote'>
                                hier wird diese news bewertet:<br>
                                diese news<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up'/>
                                <label for='ratingrulez'>ist super</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                <label for='ratingpig'>ist ok</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down'/>
                                <label for='ratingsucks'>ist scheiße</label>
                            </div>
                        @endif
                        @include('_partials.markdown_editor')
                        <div><a href='/?page=faq#markdown'><b>markown</b></a> kann benutzt werden</div>
                    </div>
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                    {!! Form::close() !!}
                </div>
                @else
                    <div class="rmarchivtbl" id="rmarchivbox_prodpost">
                        <h2>Keine Berechtigung</h2>
                        <div class="content">
                            Dir fehlen die Berechtigung Kommentare zu posten.
                        </div>
                    </div>
                    @endpermission
            </div>
        @else
            <h2>zu dieser id existiert keine ressource</h2>
        @endif
    </div>
@endsection