@extends('layouts.app')
@section('pagetitle', 'spiel bearbeiten')
@section('content')
    <div id="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>spiel bearbeiten</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <h2>Bearbeiten von: <a href="{{ url('games', $game->gameid) }}">{{ $game->gametitle }}</a></h2>

        {!! Form::open(['method' => 'PUT', 'route' => ['games.update', $game->gameid]]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{trans('app.games.edit.title')}}</h2>

            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_title">
                        <label for="title">{{trans('app.games.add.gametitle')}}</label>
                        <input name="title" id="title" value="{{ $game->gametitle }}"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_subtitle">
                        <label for="subtitle">{{trans('app.games.add.subtitle')}}</label>
                        <input name="subtitle" id="subtitle" value="{{ $game->gamesubtitle }}"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class='row' id='row_maker'>
                        <label for='maker'>{{trans('app.games.add.maker')}}</label>
                        <select name='maker' id='maker'>
                            <option value="0">{{trans('app.games.add.maker_choose')}}</option>
                            @foreach($makers as $maker)
                                @if($game->gamemakerid == $maker->id)
                                    <option selected="selected" value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @else
                                    <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class='row' id='row_language'>
                        <label for='language'>{{trans('app.games.add.language')}}</label>
                        <select name='language' id='language'>
                            <option value="0">{{trans('app.games.add.langauge_choose')}}</option>
                            @foreach($langs as $lang)
                                @if($game->gamelangid == $lang->id)
                                    <option selected="selected" value="{{ $lang->short }}">{{ $lang->name }}</option>
                                @else
                                    <option value="{{ $lang->short }}">{{ $lang->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_releasedate">
                        <label for="releasedate">{{trans('app.games.gamefiles.release_date2')}}</label>
                        <div class="formdate" id="releasedate">
                            @php $reldate = \Carbon\Carbon::parse($game->release_date) @endphp
                            <select name="releasedate_day" id="releasedate_day">
                                <option value="0">{{trans('app.games.gamefiles.day')}}</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option value="{{ $i }}"
                                    @if($reldate->day == $i and $reldate->year != -1)
                                        selected="selected"
                                    @endif
                                    >{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_month" id="releasedate_month">
                                <option value="0">{{trans('app.games.gamefiles.month')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}"
                                            @if($reldate->month == $i and $reldate->year != -1)
                                            selected="selected"
                                            @endif
                                    >{{ trans('app.misc.month.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_year" id="releasedate_year">
                                <option value="0">{{trans('app.games.gamefiles.year')}}</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}"
                                            @if($reldate->year == $i and $reldate->year != -1)
                                            selected="selected"
                                            @endif
                                    >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <h2>{{trans('app.games.add.description_title')}}</h2>
            <div class="content">
                    @include('_partials.markdown_editor', ['edit_text' => $game->gamedescmd])
            </div>

            <h2>{{trans('app.games.add.links')}}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_websiteurl">
                        <label for="websiteurl">{{trans('app.games.add.website')}}</label>
                        <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value="{{ $game->websiteurl }}"/>
                    </div>
                    <div class="row" id="row_youtube">
                        <label for="youtube">trailer (youtube)</label>
                        <input name="youtube" id="youtube" placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8" value="{{ $game->youtube }}"/>
                    </div>
                </div>
            </div>

            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        {!! Form::close() !!}

        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{trans('app.games.edit.developer')}}</h2>
            <div class="content">
                <div class="formifier">
                    @foreach($developers as $dev)
                    <div class="row" id="row_dev_{{ $dev->devid }}">
                        {!! Form::open(['method' => 'POST', 'route' => ['games.developer.delete', $game->gameid]]) !!}
                        {!! Form::hidden('devid', $dev->devid) !!}
                        {!! Form::label($dev->devid, $dev->devname) !!}
                        {!! Form::submit(trans('app.misc.delete'),['name' => $dev->devid]) !!}
                        {!! Form::close() !!}
                    </div>
                    @endforeach
                </div>
            </div>

        {!! Form::open(['method' => 'POST', 'route' => ['games.developer.store', $game->gameid]]) !!}
            <h2>{{trans('app.games.edit.developer_add')}}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_developer">
                        <label for="developer">{{trans('app.games.add.developer')}}</label>
                        <input autocomplete="off" class="auto" name="developer" id="developer" placeholder="{{trans('app.games.edit.developer_help')}}" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                var sourcepath = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    //prefetch: '../data/films/post_1960.json',
                    remote: {
                        url: '/ac_developer/%QUERY',
                        wildcard: '%QUERY'
                    }
                });

                $('#row_developer .auto').typeahead(null, {
                    name: 'developers',
                    display: 'value',
                    source: sourcepath,
                    limit: 5,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            '{{trans('app.misc.nothing_found')}}',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            console.log(data);
                            return '<p><strong>' + data.value + '</strong></p>';
                        }
                    }
                });
            </script>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        {!! Form::close() !!}
        </div>

        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>zugewiesene tags</h2>
            <table id="'rmarchivbox_prodlist" class="boxtable pagedtable">
                <thead>
                    <tr>
                        <th>tag</th>
                        <th>aktionen</th>
                    </tr>
                </thead>
                @foreach($tags as $t)
                    <tr>
                        <td>{{ $t->tag->title }}</td>
                        <td><a href="{{ action('TaggingController@delete_gametag', [$game->gameid, $t->tag->id]) }}">entfernen</a></td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>verbundene user credits</h2>
            <table id='rmarchivbox_prodlist' class='boxtable pagedtable'>
                <thead>
                    <tr class='sortable'>
                        <th>user</th>
                        <th>bereich</th>
                        <th>aktionen</th>
                    </tr>
                </thead>
                @foreach($credits as $cr)
                    <tr>
                        <td>
                            <a class='usera' href='{{ url('users', $cr->userid) }}' title="{{ $cr->username }}">
                                <img alt="{{ $cr->username }}" class='avatar' src='http://ava.rmarchiv.de/?gender=male&id={{ $cr->userid }}'>
                            </a>
                            <span class='prod'><a href='{{ url('users', $cr->userid) }}' class='user'>{{ $cr->username }}</a></span>
                        </td>
                        <td>
                            {{ $credittypes[$cr->credit_type_id]['title'] }}
                        </td>
                        <td>
                            [<a href="{{ action('UserCreditsController@destroy', [$game->gameid, $cr->id]) }}">löschen</a>]
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! Form::open(['method' => 'POST', 'route' => ['gamecredits.store', $game->gameid]]) !!}
            <h2>credits hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_user">
                        <label for="user">benutzername</label>
                        <input autocomplete="off" class="auto" name="user" id="user" placeholder="{{trans('app.games.edit.developer_help')}}" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_credittype">
                        <label for="credit">bereich:</label>
                        <select name='credit' id='credit'>
                            <option value="0">Bitte Bereich auswählen</option>
                        @foreach($credittypes as $ct)
                            <option value="{{ $ct['id'] }}">{{$ct['title']}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                var sourcepath = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    //prefetch: '../data/films/post_1960.json',
                    remote: {
                        url: '/ac_user/%QUERY',
                        wildcard: '%QUERY'
                    }
                });

                $('#row_user .auto').typeahead(null, {
                    name: 'user',
                    display: 'value',
                    source: sourcepath,
                    limit: 5,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            '{{trans('app.misc.nothing_found')}}',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            console.log(data);
                            return '<p><strong>' + data.value + '</strong></p>';
                        }
                    }
                });
            </script>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
            {!! Form::close() !!}
        </div>

        @permission(("delete-games"))
        <div class="rmarchivtbl errorbox" id="rmarchivbox_submitprod">
            <h2>löschen des spiels</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_delete">
                        {!! Form::open(['method' => 'DELETE', 'action' => ['GameController@destroy', $game->gameid]]) !!}
                        <label for="confirm">tippe CONFIRM+GameID zur bestätigung</label>
                        <input name="confirm" id="confirm" placeholder="CONFIRM+1014" value=""/>
                        <span> [<span class="req">req</span>]</span>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        @endpermission

    </div>
@endsection