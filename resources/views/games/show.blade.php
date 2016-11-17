@extends('layouts.app')
@section('content')
    <div id="content">
        @if(count($game) > 0)
            <div id="prodpagecontainer">
                <table id='rmarchivbox_prodmain'>
                    <tr id='prodheader'>
                        <th colspan='3'>
                            <span id='title'><big>{{ $game->title }}</big> :: {{ $game->subtitle }}</span>
                            @if($game->userid == Auth::id() or Auth::user()->settings->is_admin == 1)
                                <div id='nfo'>[<a href='{{ route('games.edit', [ 'id' => $game->gameid]) }}'>edit</a>]</div>
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td rowspan='3' id='screenshot'>
                            <img src='/content/screenshots/@{{ data.pictitle }}' style="width: 400px"  alt='Titelbild' title='Titelbild' />
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
                                                <span class='type type_@{{ data.game_type }}'>@{{ data.game_type }}</span> @{{ data.game_type }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Entwickler :</td>
                                    <td>
                                        @foreach($developer as $dev)
                                        <a href="/?page=creator&id={{ $dev->id }}">{{ $dev->name }}</a>
                                            @if($dev != $developer->last())
                                                ::
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>release date:</td>
                                    <td>{{ $releasedate->release_year }}-{{ $releasedate->release_month }}-{{ $releasedate->release_day }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul>
                                <li><img src='/assets/rate_up.gif' alt='super' />&nbsp;{{ $game->voteup or 0 }}</li>
                                <li><img src='/assets/rate_down.gif' alt='scheiße' />&nbsp;{{ $game->votedown or 0 }}</li>
                            </ul>
                        </td>
                        <td id='popularity'>
                            popularität : totalviewsinpercent
                            <br/>
                            <div class='outerbar' title='0%'>
                                <div class='innerbar' style='width: @{{ data.views.percent }}%'>&nbsp;<span>@{{ data.views.percent }}%</span>
                                </div>
                            </div>
                            <div class='awards'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class='r2'>
                            <ul id='avgstats'>
                                @if($game->voteup > $game->votedown)
                                    <li><img src='/assets/rate_up.gif' alt='ok' />&nbsp;{{ $game->voteavg or 0 }}</li>
                                @elseif($game->voteup < $game->votedown)
                                    <li><img src='/assets/rate_down.gif' alt='ok' />&nbsp;{{ $game->voteavg or 0 }}</li>
                                @elseif($game->voteup = $game->votedown)
                                    <li><img src='/assets/rate_neut.gif' alt='ok' />&nbsp;{{ $game->voteavg or 0 }}</li>
                                @else
                                    <li><img src='/assets/rate_neut.gif' alt='ok' />&nbsp;{{ $game->voteavg or 0 }}</li>
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
                                    {{ str_pad($f->fileyear, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->filemonth, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->fileday, 2, 0, STR_PAD_LEFT) }}
                                    @if(Auth::check())
                                        [<a href="{{ url('games/download', $f->fileid) }}">{{ $f->filetypetitle }} - {{ $f->fileversion }}</a>] ({{ $f->downloadcount }})
                                    @endif
                                </li>
                                @endforeach
                                <li>------------</li>
                                <li><a href="{{ action('GameFileController@create', $game->gameid) }}">dateiliste/hinzufügen</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td id='credits' colspan='3' class='r2'>
                            <ul>
                                {#
                                <li>
                                    <a href='user.php?who=1230' class='usera' title="se7en"><img src='http://content.pouet.net/avatars/rez64.gif' alt="se7en" class='avatar' />
                                    </a> <a href='user.php?who=1230' class='user'>se7en</a> [code, graphics]
                                </li>
                                <li>
                                    <a href='user.php?who=43119' class='usera' title="dalezy"><img src='http://content.pouet.net/avatars/dalezy3.gif' alt="dalezy" class='avatar' />
                                    </a> <a href='user.php?who=43119' class='user'>dalezy</a> [music]
                                </li>
                                #}
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
                            {% for aw in data.awards %}
                            <ul>
                                <li>
                                    <img src="/assets/imgs/@{{ aw.medal }}">(@{{ aw.year }}) Platz @{{ aw.place }} - @{{ aw.page }} <a href="/?page=award&website=@{{ aw.page }}&year=@{{ aw.year }}&title=@{{ aw.title }}">@{{ aw.title }} - @{{ aw.subtitle }}</a>
                                </li>
                            </ul>
                            {% endfor %}
                        </td>
                    </tr>
                    <tr>
                        <td class='foot' colspan='3'>hinzugefügt am {{ $game->createdate }} von <a href='{{ url('users', $game->userid) }}' class='user'>{{ $game->username }}</a>
                            <a href='{{ url('users', $game->userid) }}' class='usera' title="{{ $game->username }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $game->userid }}' alt="{{ $game->username }}" class='avatar' />
                            </a>
                        </td>
                    </tr>
                </table>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('app.news.popularity_helper.title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.news.popularity_helper.msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
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

                                    <span class='tools' data-cid='{{ $game->gameid }}'></span> hinzugefügt am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}' class='user'>{{ $comment->name }}</a>
                                    <a href='{{ url('users', $comment->user_id) }}' class='usera' title="{{ $comment->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}' alt="{{ $comment->name }}" class='avatar' />
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
                        <p>wip</p>
                    </div>
                </div>

                @if(Auth::check())
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
                                    <input type='radio' name='rating' id='ratingrulez' value='up' />
                                    <label for='ratingrulez'>ist super</label>
                                    <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked' />
                                    <label for='ratingpig'>ist ok</label>
                                    <input type='radio' name='rating' id='ratingsucks' value='down' />
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
                @endif
            </div>
        @else
            <h2>zu dieser id existiert keine news</h2>
        @endif
    </div>
@endsection