@extends('layouts.app')
@section('pagetitle', $game->title)
@section('content')
    <div id="content">
        @if(count($game) > 0)
            <div id="prodpagecontainer">
                <table id='rmarchivbox_prodmain'>
                    <tr id='prodheader'>
                        <th colspan='3'>
                            <span id='title'><big>{{ $game->title }}</big>@if($game->subtitle) :: {{ $game->subtitle }}@endif</span>
                            @if(Auth::check())
                                <script>
                                    function listDD() {
                                        document.getElementById("myUserList").classList.toggle("show");
                                    }

                                    window.onclick = function(event) {
                                        if (!event.target.matches('.dropbtn')) {

                                            var dropdowns = document.getElementsById("myUserList");
                                            var i;
                                            for (i = 0; i < dropdowns.length; i++) {
                                                var openDropdown = dropdowns[i];
                                                if (openDropdown.classList.contains('show')) {
                                                    openDropdown.classList.remove('show');
                                                }
                                            }
                                        }
                                    }
                                </script>
                                <div id='nfo'>
                                    [<button onclick="listDD()" class="dropbtn">+</button>]
                                    <div id="myUserList" class="dropdown-content">
                                        <a href="{{ url('lists/create') }}">{{ trans('games.show.userlist_create') }}</a>
                                        @if(Auth::user()->userlists)
                                            @foreach(Auth::user()->userlists as $list)
                                                <a href="{{ route('lists.add_game', [$list->id, $game->id])  }}">{{ $list->title }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                @permission(('create-games'))
                                    [<a href='{{ route('games.edit', [ 'id' => $game->id]) }}'>{{ trans('games.show.edit') }}</a>]
                                @endpermission
                                    [<a href="{{ route('history.game.index', ['id' => $game->id]) }}">{{ trans('games.show.history') }}</a>]
                                </div>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td rowspan='3' id='screenshot'>
                            <script>
                                $(function () {
                                    $("#tabs").tabs();
                                });
                            </script>
                            <div id="tabs" class="style-tabs">
                                <ul>
                                    <li><a href="#tabs-1">{{ trans('games.show.titlescreen') }}</a></li>
                                    <li><a href="#tabs-2">{{ trans('games.show.screenshot') }} 1</a></li>
                                    <li><a href="#tabs-3">{{ trans('games.show.screenshot') }} 2</a></li>
                                    <li><a href="#tabs-4">{{ trans('games.show.screenshot') }} 3</a></li>
                                    <li><a href="#tabs-5">{{ trans('games.show.screenshot') }} 4</a></li>
                                    <li><a href="#tabs-6">{{ trans('games.show.screenshot') }} 5</a></li>
                                    @if($game->youtube)
                                        <li><a href="#tabs-7">{{ trans('games.show.trailer') }}</a></li>
                                    @endif
                                </ul>
                                <div id="tabs-1">
                                    <img src='{{ route('screenshot.show', [$game->id, 1]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.titlescreen') }}' title='{{ trans('games.show.titlescreen') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 1, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                    @if(Auth::check())
                                        :: <a href="{{ route('screenshot.create', [$game->id, 1]) }}">{{ trans('games.show.upload_titlescreen') }}</a>
                                    @endif
                                    </span>
                                </div>
                                <div id="tabs-2">
                                    <img src='{{ route('screenshot.show', [$game->id, 2]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.screenshot') }}' title='{{ trans('games.show.screenshot') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 2, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                        @if(Auth::check())
                                            :: <a href="{{ route('screenshot.create', [$game->id, 2]) }}">{{ trans('games.show.upload_screenshot') }}</a>
                                        @endif
                                    </span>
                                </div>
                                <div id="tabs-3">
                                    <img src='{{ route('screenshot.show', [$game->id, 3]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.screenshot') }}' title='{{ trans('games.show.screenshot') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 3, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                        @if(Auth::check())
                                            :: <a href="{{ route('screenshot.create', [$game->id, 3]) }}">{{ trans('games.show.upload_screenshot') }}</a>
                                        @endif
                                    </span>
                                </div>
                                <div id="tabs-4">
                                    <img src='{{ route('screenshot.show', [$game->id, 4]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.screenshot') }}' title='{{ trans('games.show.screenshot') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 4, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                        @if(Auth::check())
                                            :: <a href="{{ route('screenshot.create', [$game->id, 4]) }}">{{ trans('games.show.upload_screenshot') }}</a>
                                        @endif
                                    </span>
                                </div>
                                <div id="tabs-5">
                                    <img src='{{ route('screenshot.show', [$game->id, 5]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.screenshot') }}' title='{{ trans('games.show.screenshot') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 5, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                        @if(Auth::check())
                                            :: <a href="{{ route('screenshot.create', [$game->id, 5]) }}">{{ trans('games.show.upload_screenshot') }}</a>
                                        @endif
                                    </span>
                                </div>
                                <div id="tabs-6">
                                    <img src='{{ route('screenshot.show', [$game->id, 6]) }}' style="width: 400px"
                                         alt='{{ trans('games.show.screenshot') }}' title='{{ trans('games.show.screenshot') }}'/>
                                    <span>
                                        <a href="{{ route('screenshot.show', [$game->id, 6, 1]) }}">{{ trans('games.show.show_origsize') }}</a>
                                        @if(Auth::check())
                                            :: <a href="{{ route('screenshot.create', [$game->id, 6]) }}">{{ trans('games.show.upload_screenshot') }}</a>
                                        @endif
                                    </span>
                                </div>
                                @if($game->youtube)
                                    @php
                                        $vid = str_replace('watch?v=', "embed/", $game->youtube);
                                    @endphp
                                <div id="tabs-7">
                                    <iframe width="400px" height="300px" src="{{ $vid }}" frameborder="0" allowfullscreen></iframe>
                                </div>

                                @endif
                            </div>
                        </td>
                        <td colspan='2'>
                            <table id='stattable'>
                                <tr>
                                    <td>{{ trans('games.show.maker') }} :</td>
                                    <td>
                                        <a href="{{ route('maker.show', $game->maker->id) }}">
                                        <span class="type type_{{ $game->maker->short }}">{{ $game->maker->title }}</span> {{ $game->maker->title }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('games.show.gametype') }} :</td>
                                    <td>
                                        <ul>
                                            <li>
                                                @if(count($game->gamefiles) > 0)
                                                    <span class='type type_{{ $game->gamefiles->first()->gamefiletype->short }}'>{{ $game->gamefiles->first()->gamefiletype->title }}</span> {{ $game->gamefiles->first()->gamefiletype->title }}
                                                @else
                                                    {{ trans('games.show.no_gamefile') }}
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('games.show.developer') }} :</td>
                                    <td>
                                        @foreach($game->developers as $dev)
                                            <a href="{{ url('developer',$dev->developer_id) }}">{{ $dev->developer->name }}</a>
                                            @if($dev != $game->developers->last())
                                                ::
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                    <tr>
                                        <td>{{ trans('games.show.release_date') }}:</td>
                                        <td>{{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id) }}</td>
                                    </tr>
                                @if($game->website_url)
                                    <tr>
                                        <td>{{ trans('games.show.website') }}:</td>
                                        <td><a href="{{ $game->website_url }}" target="_blank">{{ trans('games.show.website_click') }}</a></td>
                                    </tr>
                                @endif
                                @if($game->atelier_id)
                                    <tr>
                                        <td>{{ trans('games.show.atelier_link') }}:</td>
                                        <td><a href="http://www.rpg-atelier.net/index.php?site=showgame&gid={{ $game->atelier_id }}" target="_blank">{{ trans('games.show.website_click') }}</a></td>
                                    </tr>
                                @endif
                                @if(Auth::check())
                                    <tr>
                                        <td>{{ trans('games.show.play_in_browser') }}</td>
                                        <td><a href="{{ action('PlayerController@index', $game->gamefiles->first()->id) }}"><img src="/assets/play_button.png" alt="play"></a></td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul>
                                <li><img src='/assets/rate_up.gif' alt='{{ trans('games.show.voteup') }}'/>&nbsp;{{ $game->votes['up'] or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='{{ trans('games.show.votedown') }}'/>&nbsp;{{ $game->votes['down'] or 0 }}
                                </li>
                            </ul>
                        </td>
                        <td id='popularity' style="width: 240px;">
                            @php
                                $perc = \App\Helpers\MiscHelper::getPopularity($game->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                            @endphp
                            {{ trans('games.show.popularity') }}: {{ round($perc, 2) }}%
                            <br/>
                            <div class='outerbar' title='{{ round($perc, 2) }}%'>
                                <div class='innerbar' style='width: {{ $perc }}%'>&nbsp;<span>{{ $perc }}%</span>
                                </div>
                            </div>
                            <div class='awards'>{{ trans('games.show.tags') }}:
                                @if(Auth::check())
                                    <script>
                                        function tagDD() {
                                            document.getElementById("myNewTag").classList.toggle("show");
                                        }
                                    </script>
                                    <div id='nfo'>
                                        [<button onclick="tagDD()" class="dropbtn">+</button>]
                                        <div id="myNewTag" class="dropdown-content" style="margin-left: -400px">
                                            {!! Form::open(['action' => ['TaggingController@store']]) !!}
                                            {!! Form::hidden('content_id', $game->id) !!}
                                            {!! Form::hidden('content_type', 'game') !!}
                                            <div class="formifier">
                                                <div class="row" id="row_developer">
                                                    <label for="title" style="color: black">{{ trans('games.show.tag_add') }}</label>
                                                    <input name="title" id="title" placeholder="" value=""/>
                                                </div>
                                            </div>
                                            <div class='foot'>
                                                <input type='submit' value='Submit' id='submit'>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @endif
                                <br>
                                @foreach($game->tags as $tag)
                                    <a href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}">{{ $tag->tag->title }}</a>
                                    @if($tag != $game->tags->last())
                                        ::
                                    @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul id='avgstats'>
                                @if($game->votes['up'] > $game->votes['down'])
                                    <li><img src='/assets/rate_up.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}</li>
                                @elseif($game->votes['up'] < $game->votes['down'])
                                    <li><img src='/assets/rate_down.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}</li>
                                @elseif($game->votes['up'] == $game->votes['down'])
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}</li>
                                @else
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}</li>
                                @endif
                                {{-- data.cdc > 0
                            <li><img src="/assets/cdc.png" alt="cdcs">cdc's</li>
                             endif
                             --}}
                            </ul>
                            <div id='alltimerank'>{{ trans('games.show.alltime_top') }}: #0</div>
                        </td>
                        <td id='links'>
                            <ul>
                                @foreach($game->gamefiles as $f)
                                    <li>
                                        @if(Auth::check() and !$f->forbidden == 1)
                                            {{ str_pad($f->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_day, 2, 0, STR_PAD_LEFT) }}
                                            [<a href="{{ url('games/download', $f->id) }}" class="down_l">{{ $f->gamefiletype->title }}
                                                - {{ $f->release_version }}</a>] ({{ $f->downloadcount }})
                                        @else
                                            {{ str_pad($f->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_day, 2, 0, STR_PAD_LEFT) }}
                                            [{{ $f->gamefiletype->title }}
                                                - {{ $f->release_version }}] ({{ $f->downloadcount }})
                                        @endif
                                    </li>
                                @endforeach
                                <li>------------</li>
                                <li><a href="{{ action('GameFileController@create', $game->id) }}">{{ trans('games.show.add_gamefiles') }}</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <ul>
                                @foreach($game->credits as $cr)
                                    <li>
                                        <a href='{{ url('users', $cr->user_id) }}' class='usera' title="{{ $cr->user->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $cr->user_id }}' alt="{{ $cr->user->name }}" class='avatar' />
                                        </a> <a href='{{ url('users', $cr->user_id) }}' class='user'>{{ $cr->user->name }}</a> [{{ $cr->type->title }}]
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <h2>{{ trans('games.show.gamedescription') }}</h2>
                            <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                                <div class="content">
                                    {!! $game->desc_html !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                        @foreach($game->awards as $aw)
                        <?php
                        if ($aw->place == 1) {
                            $icon = 'medal_gold.png';
                        } elseif ($aw->place == 2) {
                            $icon = 'medal_silver.png';
                        } elseif ($aw->place == 3) {
                            $icon = 'medal_bronze.png';
                        } else {
                            $icon = 'no';
                        }
                        ?>
                        <ul>
                            <li>
                                <img src="/assets/{{ $icon }}">({{ $aw->cat->year }}) {{ trans('games.show.place') }} {{ $aw->place }} - {{ $aw->page->title }} <a href="{{ url('awards', $aw->award_cat_id) }}">{{ $aw->cat->title }} - {{ $aw->subcat->title }}</a>
                            </li>
                        </ul>
                        @endforeach

                        </td>
                    </tr>
                    <tr>
                        <td>
                            [<a href="{{ action('ReportController@create_game_report', $game->id) }}">{{ trans('games.show.report_game') }}</a>]
                        </td>
                        <td class='foot' colspan='3'>{{ trans('games.show.added') }} <time datetime='{{ $game->created_at }}' title='{{ $game->created_at }}'>{{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }}</time> {{ trans('games.show.by') }} <a
                                    href='{{ url('users', $game->user_id) }}' class='user'>{{ $game->user->name }}</a>
                            <a href='{{ url('users', $game->user_id) }}' class='usera' title="{{ $game->user->name }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $game->user_id }}'
                                        alt="{{ $game->user->name }}" class='avatar'/>
                            </a>
                        </td>
                    </tr>
                </table>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('games.show.popularity_helper_title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('games.show.popularity_helper_msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                    </div>
                </div>

                @if($game->comments()->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('games.show.comments') }}</h2>
                        @foreach($game->comments()->get() as $comment)
                            <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                <div class='content'>
                                    {!! \App\Helpers\InlineBoxHelper::GameBox($comment->comment_html) !!}
                                </div>
                                <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>up</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>down</span>
                                    @endif

                                    <span class='tools' data-cid='{{ $game->id }}'></span> {{ trans('games.show.added') }} {{ $comment->created_at }} {{ trans('games.show.by') }} <a href='{{ url('user', $comment->user_id) }}'
                                                                         class='user'>{{ $comment->name }}</a>
                                    <a href='{{ url('users', $comment->user_id) }}' class='usera'
                                       title="{{ $comment->user->name }}"><img
                                                src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}'
                                                alt="{{ $comment->user->name }}" class='avatar'/>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('games.show.comments') }}</h2>
                        <div class="comment">
                            <div class="content">
                                {{ trans('games.show.no_comments') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>{{ trans('games.show.comment_rules') }}</h2>
                    <div class='content'>
                        <p>{{ trans('games.show.comment_tip1') }}</p>
                        <p>{{ trans('games.show.comment_tip2') }}</p>
                        <p>{{ trans('games.show.comment_tip3') }}</p>
                        <p>{{ trans('games.show.comment_tip4') }}</p>
                    </div>
                </div>

                @permission(('create-game-comments'))
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>{{ trans('games.show.add_comment') }}</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $game->id) !!}
                    {!! Form::hidden('content_type', 'game') !!}
                    <div class='content'>
                        @if(\App\Helpers\CheckRateableHelper::checkRateable('game', $game->gameid, Auth::id()) === true)
                            <div id='prodvote'>
                                {{ trans('games.show.rate') }}<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up'/>
                                <label for='ratingrulez'>{{ trans('games.show.voteup') }}</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                <label for='ratingpig'>{{ trans('games.show.vote_neut') }}</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down'/>
                                <label for='ratingsucks'>{{ trans('games.show.votedown') }}</label>
                            </div>
                        @endif

                        @include('_partials.markdown_editor')

                            <div><a href='/?page=faq#markdown'>{{ trans('games.show.markdown') }}</a></div>
                    </div>
                    <div class='foot'>
                        <input type='submit' value='Submit' id='submit'>
                    </div>
                    {!! Form::close() !!}
                </div>
                @else
                    <div class="rmarchivtbl" id="rmarchivbox_prodpost">
                        <h2>{{ trans('games.show.no_permissions') }}</h2>
                        <div class="content">
                            {{ trans('games.show.no_permissions_body') }}
                        </div>
                    </div>
                    @endpermission
            </div>
        @else
            <h2>{{ trans('games.show.no_id') }}</h2>
        @endif
    </div>
@endsection