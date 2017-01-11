@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_search'>
            <h2>suche</h2>
            {{ Form::open(['action' => ['SearchController@search']]) }}
                <div class='content center'>
                    @if(isset($term))
                        <input type='text' name='term' size='64' value="{{ $term }}" />
                    @else
                        <input type='text' name='term' size='64' placeholder="Suche" />
                    @endif
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' />
                </div>
            {{ Form::close() }}
        </div>
        @if(isset($term))
        <h3>suche nach: '{{ $term }}' - nach relevanz</h3><br>
        @endif

        @if(isset($games))
        <h2>spiele</h2>
        <table id='pouetbox_prodlist' class='boxtable pagedtable'>
            <tr class='sortable'>
                <th>typ
                    spielname
                <th>entwickler</th>
                <th>release date</th>
                <th>hinzugefügt</th>
                <th><img src='/assets/rate_up.gif' alt='super' /></th>
                <th><img src='/assets/rate_neut.gif' alt='ok' /></th>
                <th><img src='/assets/rate_down.gif' alt='scheiße' /></th>
                <th>avg</th>
                <th>popularität</th>
            </tr>
            @foreach($games as $game)
                <tr>
                    <td>
                        @if(is_null($game->gametype) == false)
                            <span class='typeiconlist'>
                        <span class='typei type_{{ $gametypes[$game->gametype]['short'] }}' title='{{ $gametypes[$game->gametype]['title'] }}'>{{ $gametypes[$game->gametype]['title'] }}</span>
                    </span>
                        @endif
                        <span class="platformiconlist">
                        <span class="typei type_{{ $game->makershort }}" title="{{ $game->makertitle }}">{{ $game->makertitle }}</span>
                    </span>
                        <span class='prod'>
                        <a href='{{ url('games', $game->gameid) }}'>
                            {{ $game->gametitle }}
                            @if($game->gamesubtitle != '')
                                <small> - {{ $game->gamesubtitle }}</small>
                            @endif
                        </a>
                    </span>
                        @if($game->cdccount > 0)
                            <div class="cdcstack">
                                <img src="/assets/cdc.png" title="cdc" alt="cdc">
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('developer', $game->developerid) }}">{{ $game->developername }}</a>
                    </td>
                    <td class='date'>{{ $game->releasedate }}</td>
                    <td class='date'><time datetime='{{ $game->gamecreated_at }}' title='{{ $game->gamecreated_at }}'>{{ \Carbon\Carbon::parse($game->gamecreated_at)->diffForHumans() }}</time></td>
                    <td class='votes'>{{ $game->voteup or 0 }}</td>
                    <td class='votes'>{{ $game->votedown or 0 }}</td>
                    @php $avg = @(($game->voteup - $game->votedown) / ($game->voteup + $game->votedown)) @endphp
                    <td class='votes'>{{ number_format($avg, 2) }}&nbsp;
                        @if($avg > 0)
                            <img src='/assets/rate_up.gif' alt='up' />
                        @elseif($avg == 0)
                            <img src='/assets/rate_neut.gif' alt='neut' />
                        @elseif($avg < 0)
                            <img src='/assets/rate_down.gif' alt='down' />
                        @endif
                    </td>
                    @php
                        $perc = \App\Helpers\MiscHelper::getPopularity($game->views, $maxviews);
                    @endphp
                    <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                    <td>{{ $game->commentcount }}</td>
                </tr>
            @endforeach
        </table>
        @endif

        @if(isset($developer))
        <h2>entwickler</h2>
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table class='boxtable'>
                <tr>
                    <th>entwickler</th>
                    <th>games</th>
                </tr>
                {% for c in data.creator %}
                <tr>
                    <td class='groupname'><a href='/?page=creator&id={{ c.id }}'>{{ c.name }}</a></td>
                    <td>
                        {{ c.count }}  </td>
                </tr>
                {% endfor %}
            </table>
        </div>
        @endif

        @if(isset($users))
        <h2>user</h2>
        <table id='pouetbox_userlist' class='boxtable pagedtable'>
            <tr class='sortable'>
                <th>nickname</th>
                <th>mitglied seit</th>
                <th>level</th>
                <th>obeys</th>
            </tr>
            {% for user in data.user %}
            <tr>
                <td>
                    <a href='/?page=user&id={{ user.id }}' class='usera' title="{{ user.username }}">
                        <img src='http://ava.rmarchiv.de/?gender={{ user.gender }}&id={{ user.id }}' alt="{{ user.username }}" class='avatar'/>
                    </a> <a href='/?page=user&id={{ user.id }}' class='user'>{{ user.username }}</a></td>
                <td class='date'>
                    <span title="{{ user.register_date }}">seit {{ user.register_date_since }}</span>
                </td>
                <td>
                    {% if user.is_admin == 0 %}
                    user
                    {% else %}
                    admin
                    {% endif %}
                </td>
                <td>
                    <div class='innerbar_solo' style='width: {{ user.obey_perc }}px' title='{{ user.obey }} obeys'>&nbsp;<span>{{ user.obey }} obeys</span></div>
                </td>
            </tr>
            {% endfor %}
        </table>
        @endif


        @if(isset($threads))
        <h2>board threads</h2>
        <table id='rmarchivbox_bbslist' class='boxtable pagedtable'>
            <tr class='sortable'>
                <th id='th_firstpost'>geöffnet</th>
                <th id='th_userfirstpost'>von</th>
                <th id='th_category'>kategorie</th>
                <th id='th_topic'>thema</th>
                <th id='th_count'>antworten</th>
                <th id='th_lastpost'>letzter post</th>
                <th id='th_userlastpost'>von</th>
            </tr>
            {% for thread in data.thread %}
            <tr>
                <td>{{ thread.threadcreatedate }}</td>
                <td>
                    <a href='/?page=user&id={{ thread.threadcreateuser.id }}' class='usera' title="{{ thread.threadcreateuser.username }}">
                        <img src='http://ava.rmarchiv.de/?gender={{ thread.threadcreateuser.gender }}&id={{ thread.threadcreateuser.id }}' alt="{{ thread.threadcreateuser.username }}" class='avatar'/>
                    </a> <a href='/?page=user&id={{ thread.threadcreateuser.id }}' class='user'>{{ thread.threadcreateuser.username }}</a>
                </td>
                <td>{{ thread.cattitle }}</td>
                <td class='topic'><a href='/?page=thread&id={{ thread.threadid }}'>{{ thread.threadtitle }}</a></td>
                <td>{{ thread.postcount }}</td>
                <td title='{{ thread.threadlastpostdate }}'><a href="/?page=thread&id={{ thread.threadid }}#c{{ thread.threadlastpostid }}">{{ thread.threadlastpostdate }}</a></td>
                <td><a href='/?page=user&id={{ thread.threadlastpostuser.id }}' class='usera' title="{{ thread.threadlastpostuser.username }}"><img src='http://ava.rmarchiv.de/?gender={{ thread.threadlastpostuser.gender }}&id={{ thread.threadlastpostuser.id }}' alt="{{ thread.threadlastpostuser.username }}" class='avatar'/></a> <a href='/?page=user&id={{ thread.threadlastpostuser.id }}' class='user'>{{ thread.threadlastpostuser.username }}</a></td>
            </tr>
            {% endfor %}
        </table>
        @endif

        @if(isset($posts))
        <h2>board posts</h2>
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <ul class="boxlist">
                {% for m in data.post %}
                <li><time datetime='{{ m.postdate }}' title='{{ m.postdate }}'>{{ m.postdate }}</time> <a href='/?page=user&id={{ m.postuser.id }}' class='usera' title="{{ m.postuser.username }}"><img src='http://ava.rmarchiv.de/?gender={{ m.postuser.gender }}&id={{ m.postuser.id }}' alt="{{ m.postuser.username }}" class='avatar'/> {{ m.postuser.username }}</a> :: <a href="/?page=thread&id={{ m.threadid }}#c{{ m.postid }}">zum post in {{ m.threadtitle }}</a> {{ m.postmessage|raw }}</li>
                {% endfor %}
            </ul>
        </div>
        @endif

        @if(isset($news))
        <h2>news</h2>
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <ul class="boxlist">
                {% for m in data.news %}
                <li><time datetime='{{ m.date }}' title='{{ m.date }}'>{{ m.date }}</time> <a href='/?page=user&id={{ m.user.id }}' class='usera' title="{{ m.user.username }}"><img src='http://ava.rmarchiv.de/?gender={{ m.user.gender }}&id={{ m.user.id }}' alt="{{ m.user.username }}" class='avatar'/> {{ m.user.username }}</a> :: {{ m.title }} {{ m.message|raw }}</li>
                {% endfor %}
            </ul>
        </div>
        @endif

        @if(isset($comments))
        <h2>kommentare</h2>
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <ul class="boxlist">
                {% for m in data.comment %}
                <li><time datetime='{{ m.date }}' title='{{ m.date }}'>{{ m.date }}</time> <a href='/?page=user&id={{ m.user.id }}' class='usera' title="{{ m.user.username }}"><img src='http://ava.rmarchiv.de/?gender={{ m.user.gender }}&id={{ m.user.id }}' alt="{{ m.user.username }}" class='avatar'/> {{ m.user.username }}</a> :: <a href="/?page={{ m.targettype }}&id={{ m.targetid }}#c{{ m.id }}">zum kommentar</a> {{ m.message|raw }}</li>
                {% endfor %}
            </ul>
        </div>
        @endif

        @if(isset($shoutbox))
        <h2>shoutbox</h2>
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <ul class="boxlist">
                {% for m in data.shoutbox %}
                <li><time datetime='{{ m.date }}' title='{{ m.date }}'>{{ m.date }}</time> <a href='/?page=user&id={{ m.user.id }}' class='usera' title="{{ m.user.username }}"><img src='http://ava.rmarchiv.de/?gender={{ m.user.gender }}&id={{ m.user.id }}' alt="{{ m.user.username }}" class='avatar'/></a> {{ m.msg }}</li>
                {% endfor %}
            </ul>
        </div>
        @endif
    </div>


@endsection