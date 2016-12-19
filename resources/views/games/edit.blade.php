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
                </div>
            </div>

            <h2>{{trans('app.games.add.description_title')}}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_desc">
                        <label for="desc">{{trans('app.games.add.description')}}</label>
                        <textarea name="desc" id="desc" maxlength="2000" rows="10" placeholder="{{trans('app.games.add.description_help')}}">{{ $game->gamedescmd }}</textarea>
                    </div>
                </div>
            </div>

            <h2>{{trans('app.games.add.links')}}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_websiteurl">
                        <label for="websiteurl">{{trans('app.games.add.website')}}</label>
                        <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value="{{ $game->websiteurl }}"/>
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
            <h2>verbundene user credits</h2>
            <table id='pouetbox_prodlist' class='boxtable pagedtable'>
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

    </div>
@endsection