@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_search'>
            <h2>suche</h2>
            <form action='{{ url('search') }}' method='get'>
                <input type="hidden" name="page" id="page" value="search" />
                <div class='content center'>
                    <input type='text' name='term' size='64' value="{{ Session::get('term') }}" />
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' />
                </div>
            </form>
        </div>
        <h3>suche nach: '{{ Session::get('term') }}' - nach relevanz</h3><br>

        @if(isset($games))
        <h2>spiele</h2>
        <table id='pouetbox_prodlist' class='boxtable pagedtable'>
            <tr class='sortable'>
                <th>typ
                    spielname
                <th>entwickler</th>
                <th>release date</th>
                <th>hinzugefügt</th>
                <th><img src='/assets/imgs/rate_up.gif' alt='super' /></th>
                <th><img src='/assets/imgs/rate_neut.gif' alt='ok' /></th>
                <th><img src='/assets/imgs/rate_down.gif' alt='scheiße' /></th>
                <th>avg</th>
                <th>popularität</th>
            </tr>
            {% for game in data.games if game.approved == 1 %}
            <tr>
                <td>
                    <span class='typeiconlist'>
                        <span class='typei type_{{ game.game_type }}' title='{{ game.game_type }}'>{{ game.game_type }}</span>
                    </span>
                    <span class="platformiconlist">
                        <span class="typei type_{{ game.maker.short }}" title="{{ game.maker.name }}">{{ game.maker.name }}</span>
                    </span>
                    <span class='prod'>
                        <a href='/?page=game&id={{ game.id }}'>{{ game.title }}{% if not game.subtitle == '' %}<small> - {{ game.subtitle }}</small>{% endif %}</a>
                    </span>
                </td>
                <td>
                    <a href="/?page=creator&id={{ game.creator.id }}">{{ game.creator.name }}</a>
                </td>
                <td class='date'>{{ game.release_month }}{{ game.release_year }}</td>
                <td class='date'>vor {{ game.date_add_since }}</td>
                <td class='votes'>{{ game.rating.rate_up }}</td>
                <td class='votes'>{{ game.rating.rate_neut }}</td>
                <td class='votes'>{{ game.rating.rate_down }}</td>
                <td class='votes'>{{ game.rating.avg }}&nbsp;
                    {% if game.rating.avg > 0 %}
                    <img src='/assets/imgs/rate_up.gif' alt='up' />
                    {% elseif game.rating.avg == 0 %}
                    <img src='/assets/imgs/rate_neut.gif' alt='neut' />
                    {% elseif game.rating.avg < 0 %}
                    <img src='/assets/imgs/rate_down.gif' alt='down' />
                    {% endif %}
                </td>
                <td><div class='innerbar_solo' style='width: {{ game.views.percent }}px' title='{{ game.views.percent }}%'>&nbsp;<span>{{ game.views.percent }}%</span></div></td>
            </tr>
            {% endfor %}
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