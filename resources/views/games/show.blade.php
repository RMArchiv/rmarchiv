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
                            <script>
                                $( function() {
                                    $( "#tabs" ).tabs();
                                } );
                            </script>
                            <div id="tabs" class="style-tabs">
                                <ul>
                                    <li><a href="#tabs-1">Titlebild</a></li>
                                    <li><a href="#tabs-2">Bild 1</a></li>
                                    <li><a href="#tabs-3">Bild 2</a></li>
                                    <li><a href="#tabs-4">Bild 3</a></li>
                                    <li><a href="#tabs-5">Bild 4</a></li>
                                    <li><a href="#tabs-6">Bild 5</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                                </div>
                                <div id="tabs-2">
                                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                </div>
                                <div id="tabs-3">
                                    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                                    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                                </div>
                                <div id="tabs-4">
                                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                </div>
                                <div id="tabs-5">
                                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                </div>
                                <div id="tabs-6">
                                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                                </div>
                            </div>
                            <table id="screenshots">
                                <tr>
                                    <td>
                                        <img src='/content/screenshots/@{{ data.pictitle }}' style="width: 400px"  alt='Titelbild' title='Titelbild' />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right">
                                        neues bild hochladen
                                    </td>
                                </tr>
                            </table>
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
                                        <a href="{{ url('developer',$dev->id) }}">{{ $dev->name }}</a>
                                            @if($dev != $developer->last())
                                                ::
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @if($releasedate)
                                <tr>
                                    <td>release date:</td>
                                    <td>{{ $releasedate->release_year }}-{{ $releasedate->release_month }}-{{ $releasedate->release_day }}</td>
                                </tr>
                                @endif
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