@extends('layouts.app')
@section('pagetitle', $game->title)
@section('content')
    <div id="content">
        @if(count($game) > 0)
            <div id="prodpagecontainer">
                <table id='rmarchivbox_prodmain'>
                    <tr id='prodheader'>
                        <th colspan='3'>
                            <span id='title'><big>{{ $game->title }}</big> :: {{ $game->subtitle }}</span>
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

                                            var dropdowns = document.getElementsByClassName("dropdown-content");
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
                                        @if($userlists)
                                            @foreach($userlists as $list)
                                                <a href="{{ route('lists.add_game', [$list->id, $game->gameid])  }}">{{ $list->title }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                @permission(('create-games'))
                                    [<a href='{{ route('games.edit', [ 'id' => $game->gameid]) }}'>edit</a>]
                                @endpermission
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
                                </ul>
                                <div id="tabs-1">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 1]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 1]) }}">titelbild hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-2">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 2]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 2]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-3">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 3]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 3]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-4">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 4]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 4]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-5">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 5]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 5]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                                <div id="tabs-6">
                                    <img src='{{ route('screenshot.show', [$game->gameid, 6]) }}' style="width: 400px"
                                         alt='Titelbild' title='Titelbild'/>
                                    @if(Auth::check())
                                        <span><a href="{{ route('screenshot.create', [$game->gameid, 6]) }}">screenshot hochladen</a></span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td colspan='2'>
                            <table id='stattable'>
                                <tr>
                                    <td>maker :</td>
                                    <td>
                                        <span class="type type_{{ $game->makershort }}">{{ $game->makertitle }}</span> {{ $game->makertitle }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>typ :</td>
                                    <td>
                                        <ul>
                                            <li>
                                                @if(count($files) > 0)
                                                    <span class='type type_{{ $files->first()->filetypeshort }}'>{{ $files->first()->filetypetitle }}</span> {{ $files->first()->filetypetitle }}
                                                @else
                                                    keine spieldateien vorhanden
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Entwickler :</td>
                                    <td>
                                        @foreach($developer as $dev)
                                            <a href="{{ url('developer',$dev->developer_id) }}">{{ $dev->name }}</a>
                                            @if($dev != $developer->last())
                                                ::
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @if($releasedate)
                                    <tr>
                                        <td>release date:</td>
                                        <td>{{ $releasedate->release_year }}-{{ $releasedate->release_month }}
                                            -{{ $releasedate->release_day }}</td>
                                    </tr>
                                @endif
                                @if($game->url)
                                    <tr>
                                        <td>website:</td>
                                        <td><a href="{{ $game->url }}" target="_blank">KLICK!</a></td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul>
                                <li><img src='/assets/rate_up.gif' alt='super'/>&nbsp;{{ $game->voteup or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='scheiße'/>&nbsp;{{ $game->votedown or 0 }}
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
                            <div class='awards'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul id='avgstats'>
                                @if($game->voteup > $game->votedown)
                                    <li><img src='/assets/rate_up.gif' alt='ok'/>&nbsp;{{ $game->voteavg or 0 }}</li>
                                @elseif($game->voteup < $game->votedown)
                                    <li><img src='/assets/rate_down.gif' alt='ok'/>&nbsp;{{ $game->voteavg or 0 }}</li>
                                @elseif($game->voteup = $game->votedown)
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->voteavg or 0 }}</li>
                                @else
                                    <li><img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->voteavg or 0 }}</li>
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
                                @foreach($files as $f)
                                    <li>

                                        @if(Auth::check())
                                            {{ str_pad($f->fileyear, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->filemonth, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->fileday, 2, 0, STR_PAD_LEFT) }}
                                            [<a href="{{ url('games/download', $f->fileid) }}">{{ $f->filetypetitle }}
                                                - {{ $f->fileversion }}</a>] ({{ $f->downloadcount }})
                                        @else
                                            {{ str_pad($f->fileyear, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->filemonth, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->fileday, 2, 0, STR_PAD_LEFT) }}
                                            [{{ $f->filetypetitle }}
                                                - {{ $f->fileversion }}] ({{ $f->downloadcount }})
                                        @endif
                                    </li>
                                @endforeach
                                <li>------------</li>
                                <li><a href="{{ action('GameFileController@create', $game->gameid) }}">dateiliste/hinzufügen</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <ul>
                                @foreach($credits as $cr)
                                    <li>
                                        <a href='{{ url('users', $cr->userid) }}' class='usera' title="{{ $cr->username }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $cr->userid }}' alt="{{ $cr->username }}" class='avatar' />
                                        </a> <a href='{{ url('users', $cr->userid) }}' class='user'>{{ $cr->username }}</a> [{{ $credittypes[$cr->credit_type_id]['title'] }}]
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <h2>spielbeschreibung</h2>
                            {!! $game->desc !!}
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                        @foreach($awards as $aw)
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
                                <img src="/assets/{{ $icon }}">({{ $aw->year }}) Platz {{ $aw->place }} - {{ $aw->pagetitle }} <a href="{{ url('awards', $aw->catid) }}">{{ $aw->cattitle }} - {{ $aw->subtitle }}</a>
                            </li>
                        </ul>
                        @endforeach

                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>hinzugefügt <time datetime='{{ $game->createdate }}' title='{{ $game->createdate }}'>{{ \Carbon\Carbon::parse($game->createdate)->diffForHumans() }}</time> von <a
                                    href='{{ url('users', $game->userid) }}' class='user'>{{ $game->username }}</a>
                            <a href='{{ url('users', $game->userid) }}' class='usera' title="{{ $game->username }}"><img
                                        src='http://ava.rmarchiv.de/?gender=male&id={{ $game->userid }}'
                                        alt="{{ $game->username }}" class='avatar'/>
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

                                    <span class='tools' data-cid='{{ $game->gameid }}'></span> hinzugefügt
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