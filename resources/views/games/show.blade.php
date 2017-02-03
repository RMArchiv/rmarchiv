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
                                    /* When the user clicks on the button,
                                     toggle between hiding and showing the dropdown content */
                                    function listDD() {
                                        document.getElementById("myUserList").classList.toggle("show");
                                    }

                                    // Close the dropdown menu if the user clicks outside of it
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
                                        <a href="{{ url('lists/create') }}">erstelle userliste</a>
                                        @if(Auth::user()->userlists)
                                            @foreach(Auth::user()->userlists as $list)
                                                <a href="{{ route('lists.add_game', [$list->id, $game->id])  }}">{{ $list->title }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                @permission(('create-games'))
                                    [<a href='{{ route('games.edit', [ 'id' => $game->id]) }}'>edit</a>]
                                @endpermission
                                    [<a href="{{ route('history.game.index', ['id' => $game->id]) }}">history</a>]
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
                                    <li><a href="#tabs-1">titlebild</a></li>
                                    <li><a href="#tabs-2">bild 1</a></li>
                                    <li><a href="#tabs-3">bild 2</a></li>
                                    <li><a href="#tabs-4">bild 3</a></li>
                                    <li><a href="#tabs-5">bild 4</a></li>
                                    <li><a href="#tabs-6">bild 5</a></li>
                                    @if($game->youtube)
                                        <li><a href="#tabs-7">trailer</a></li>
                                    @endif
                                </ul>
                                <div id="tabs-1">
                                    <img src='{{ route('screenshot.show', [$game->id, 1]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 1]) }}">titelbild hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-2">
                                    <img src='{{ route('screenshot.show', [$game->id, 2]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 2]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-3">
                                    <img src='{{ route('screenshot.show', [$game->id, 3]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 3]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-4">
                                    <img src='{{ route('screenshot.show', [$game->id, 4]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 4]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-5">
                                    <img src='{{ route('screenshot.show', [$game->id, 5]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 5]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-6">
                                    <img src='{{ route('screenshot.show', [$game->id, 6]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->id, 6]) }}">screenshot hochladen</a></span>
                                    @endif
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
                                    <td>maker :</td>
                                    <td>
                                        <span class="type type_{{ $game->maker->short }}">{{ $game->maker->title }}</span> {{ $game->maker->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>typ :</td>
                                    <td>
                                        <ul>
                                            <li>
                                                @if(count($game->gamefiles) > 0)
                                                    <span class='type type_{{ $game->gamefiles->first()->gamefiletype->short }}'>{{ $game->gamefiles->first()->gamefiletype->title }}</span> {{ $game->gamefiles->first()->gamefiletype->title }}
                                                @else
                                                    keine spieldateien vorhanden
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>entwickler :</td>
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
                                        <td>release date:</td>
                                        <td>{{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id) }}</td>
                                    </tr>
                                @if($game->website_url)
                                    <tr>
                                        <td>website:</td>
                                        <td><a href="{{ $game->website_url }}" target="_blank">KLICK!</a></td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul>
                                <li><img src='/assets/rate_up.gif' alt='super'/>&nbsp;{{ $game->votes['up'] or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='scheiße'/>&nbsp;{{ $game->votes['down'] or 0 }}
                                </li>
                            </ul>
                        </td>
                        <td id='popularity'>
                            @php
                                $perc = \App\Helpers\MiscHelper::getPopularity($game->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                            @endphp
                            popularität: {{ round($perc, 2) }}%
                            <br/>
                            <div class='outerbar' title='{{ round($perc, 2) }}%'>
                                <div class='innerbar' style='width: {{ $perc }}%'>&nbsp;<span>{{ $perc }}%</span>
                                </div>
                            </div>
                            <div class='awards'>Tags:
                                @if(Auth::check())
                                    <script>
                                        /* When the user clicks on the button,
                                         toggle between hiding and showing the dropdown content */
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
                                                    <label for="title" style="color: black">Neuen Tag hinzufügen</label>
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
                            <div id='alltimerank'>alltime top: #0</div>
                        </td>
                        <td id='links'>
                            <ul>
                                @foreach($game->gamefiles as $f)
                                    <li>
                                        @if(Auth::check() and !$f->forbidden == 1)
                                            {{ str_pad($f->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_day, 2, 0, STR_PAD_LEFT) }}
                                            [<a href="{{ url('games/download', $f->id) }}">{{ $f->gamefiletype->title }}
                                                - {{ $f->release_version }}</a>] ({{ $f->downloadcount }})
                                        @else
                                            {{ str_pad($f->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_day, 2, 0, STR_PAD_LEFT) }}
                                            [{{ $f->gamefiletype->title }}
                                                - {{ $f->release_version }}] ({{ $f->downloadcount }})
                                        @endif
                                    </li>
                                @endforeach
                                <li>------------</li>
                                <li><a href="{{ action('GameFileController@create', $game->id) }}">dateiliste/hinzufügen</a>
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
                        <td id='credits' colspan='3' class='r2'>
                            <h2>spielbeschreibung</h2>
                            {!! $game->desc_html !!}
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                        @foreach($game->awards as $aw)
                        <?php
                        if($aw->place == 1){
                            $icon = 'medal_gold.png';
                        }elseif($aw->place == 2){
                            $icon = 'medal_silver.png';
                        }elseif($aw->place == 3){
                            $icon = 'medal_bronze.png';
                        }else{
                            $icon = 'no';
                        }
                        ?>
                        <ul>
                            <li>
                                <img src="/assets/{{ $icon }}">({{ $aw->cat->year }}) Platz {{ $aw->place }} - {{ $aw->page->title }} <a href="{{ url('awards', $aw->award_cat_id) }}">{{ $aw->cat->title }} - {{ $aw->subcat->title }}</a>
                            </li>
                        </ul>
                        @endforeach

                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>hinzugefügt <time datetime='{{ $game->created_at }}' title='{{ $game->created_at }}'>{{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }}</time> von <a
                                    href='{{ url('users', $game->user_id) }}' class='user'>{{ $game->user->name }}</a>
                            <a href='{{ url('users', $game->user_id) }}' class='usera' title="{{ $game->user->name }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $game->user_id }}'
                                        alt="{{ $game->user->name }}" class='avatar'/>
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

                @if($game->comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        @foreach($game->comments as $comment)
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

                                    <span class='tools' data-cid='{{ $game->id }}'></span> hinzugefügt
                                    am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}'
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
                    {!! Form::hidden('content_id', $game->gameid) !!}
                    {!! Form::hidden('content_type', 'game') !!}
                    <div class='content'>
                        @if(CheckRateable::checkRateable('game', $game->gameid, Auth::id()) === true)
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
                        <textarea name='comment' id='comment'></textarea>
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
            <h2>zu dieser id existiert kein spiel</h2>
        @endif
    </div>
@endsection