@extends('layouts.app')
@section('pagetitle', 'spiel bearbeiten')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    @if($game->subtitle)
                        {{ $game->title }}
                        <small> - {{ $game->subtitle }}</small> bearbeiten
                    @else
                        {{ $game->title }} bearbeiten
                    @endif

                </h1>
                {!! Breadcrumbs::render('game-edit', $game) !!}
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="row">
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Fehler!</h4>
                    <p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                    </p>
                </div>
            </div>
        @endif
        {!! Form::open(['method' => 'PUT', 'route' => ['games.update', $game->id]]) !!}
        <div class="row">
            <div class="panel panel-default form">
                <div class="panel-heading">
                    grundinformationen
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">{{trans('games.edit.gametitle')}} *</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">{{trans('games.edit.subtitle')}} *</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" name="subtitle" value="{{ $game->subtitle }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='maker' class="col-lg-2 control-label">{{trans('games.edit.maker')}} *</label>
                        <div class="col-lg-10">
                            <select name='maker' id='maker' class="form-control">
                                <option value="0">{{trans('games.create.maker_choose')}}</option>
                                @foreach($makers as $maker)
                                    @if($game->maker_id == $maker->id)
                                        <option selected="selected" value="{{ $maker->id }}">{{ $maker->title }}</option>
                                    @else
                                        <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-lg-2 control-label" for='language'>{{trans('games.create.language')}} *</label>
                        <div class="col-lg-10">
                            <select name='language' id='language' class="form-control">
                                <option value="0">{{trans('games.create.language_choose')}}</option>
                                @foreach($langs as $lang)
                                    @if($game->lang_id == $lang->id)
                                        <option selected="selected" value="{{ $lang->short }}">{{ $lang->name }}</option>
                                    @else
                                        <option value="{{ $lang->short }}">{{ $lang->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label class="col-lg-2 control-label" for="releasedate_day">{{trans('games.edit.release_date')}}</label>
                        <div class="col-lg-10">
                        <div class="form-group">
                            @php $reldate = \Carbon\Carbon::parse($game->release_date) @endphp
                            <select name="releasedate_day" id="releasedate_day" class="form-control">
                                <option value="0">{{trans('games.edit.release_day')}}</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option value="{{ $i }}"
                                            @if($reldate->day == $i and $reldate->year != -1)
                                            selected="selected"
                                            @endif
                                    >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="releasedate_month" id="releasedate_month" class="form-control">
                                <option value="0">{{trans('games.edit.release_month')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}"
                                            @if($reldate->month == $i and $reldate->year != -1)
                                            selected="selected"
                                            @endif
                                    >{{ trans('_misc.month.'.$i) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="releasedate_year" id="releasedate_year" class="form-control">
                                <option value="0">{{trans('games.edit.release_year')}}</option>
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
                    <div class="form-group">
                        <label for="atelier_id" class="col-lg-2 control-label">{{trans('games.edit.atelierid')}} *</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="atelier_id" name="ateilier_id" value="{{ $game->atelier_id }}">
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    {{trans('games.edit.gamedescription')}}
                </div>
                <div class="panel-body">
                    @include('_partials.markdown_editor', ['edit_text' => $game->desc_md])
                </div>

                <div class="panel-heading">
                    {{trans('games.edit.links')}}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="websiteurl" class="col-lg-2 control-label">{{trans('games.edit.game_website')}} *</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="websiteurl" name="websiteurl" value="{{ $game->website_url }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="col-lg-2 control-label">{{ trans('games.edit.trailer') }} *</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="youtube" name="youtube"  placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8" value="{{ $game->youtube }}">
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <input type="submit" value="{{trans('games.edit.send')}}" class="btn btn-primary">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('games.edit.developer')}}
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        @foreach($game->developers as $dev)
                            <div id="row_dev_{{ $dev->developer->id }}">
                                {!! Form::open(['method' => 'POST', 'route' => ['games.developer.delete', $game->id]]) !!}
                                {!! Form::hidden('devid', $dev->developer->id) !!}
                                {!! Form::label($dev->id, $dev->developer->name) !!}
                                {!! Form::submit(trans('games.edit.delete'),['name' => $dev->developer->id, 'class' => 'btn btn-default']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-heading">
                    {{trans('games.edit.developer_add')}}
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'POST', 'route' => ['games.developer.store', $game->id]]) !!}
                    <div class="form-group" id="row_developer">
                        <label for="developer" class="col-lg-2 control-label">{{trans('games.edit.developer')}}</label>
                        <div class="col-lg-10">
                            <input autocomplete="off" type="text" class="auto form-control" id="developer" name="developer" value="">
                        </div>
                    </div>
                    <input class="btn btn-default" type="submit" value="{{trans('games.edit.send')}}">

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
                                    '{{trans('games.edit.not_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function (data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>';
                                }
                            }
                        });
                    </script>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('games.edit.added_tags') }}
                </div>
                <ul class="list-group">
                    @foreach($game->tags as $t)
                        <li class="list-group-item">
                            {{ $t->tag->title }}
                            <div class="badge">
                                <a class="btn btn-default btn-xs" href="{{ action('TaggingController@delete_gametag', [$game->gameid, $t->tag->id]) }}">{{trans('games.edit.delete')}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('games.edit.added_credits')}}
                </div>
                <ul class="list-group">
                    @foreach($game->credits as $credit)
                        <li class="list-group-item">
                            <a class='usera' href='{{ url('users', $cr->userid) }}' title="{{ $cr->username }}">
                                <img alt="{{ $cr->username }}" class='avatar' src='http://ava.rmarchiv.de/?gender=male&id={{ $cr->userid }}'>
                            </a>
                            <span class='prod'><a href='{{ url('users', $cr->userid) }}' class='user'>{{ $cr->username }}</a></span>
                            - {{ $credit->type->name }}
                            <div class="badge">
                                <a class="btn btn-default btn-xs" href="{{ action('UserCreditsController@destroy', [$game->gameid, $cr->id]) }}">{{trans('games.edit.delete')}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="panel-heading">
                    {{trans('games.edit.add_credits')}}
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'POST', 'route' => ['gamecredits.store', $game->gameid], 'class' => 'form-horizontal']) !!}
                    <div class="form-group" id="row_user">
                        <label for="user" class="col-lg-2 control-label">{{trans('games.edit.username')}}:</label>
                        <div class="col-lg-10">
                            <input autocomplete="off" class="auto form-control" name="user" id="user" placeholder="{{trans('games.edit.username')}}" value=""/>
                        </div>
                    </div>
                    <div class="form-group" id="row_credittype">
                        <label for="credit" class="col-lg-2 control-label">{{trans('games.edit.part')}}:</label>
                        <div class="col-lg-10">
                            <select name='credit' id='credit' class="form-control">
                                <option value="0">{{trans('games.edit.part_choose')}}</option>
                                @foreach(\App\Models\UserCreditType::get() as $ct)
                                    <option value="{{ $ct->id }}">{{$ct->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-default" type="submit" value="{{trans('games.edit.send')}}">
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
                                    '{{trans('games.edit.part_not_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function (data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>';
                                }
                            }
                        });
                    </script>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @permission(('delete-games'))
        <div class="row">
            <div class="panel panel-warning">
                {!! Form::open(['method' => 'DELETE', 'action' => ['GameController@destroy', $game->gameid]]) !!}
                <div class="panel-heading">
                    {{trans('games.edit.game_delete')}}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="confirm" class="col-lg-2 control-label">{{trans('games.edit.game_delete_tip')}}</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="confirm" id="confirm" placeholder="CONFIRM+1014" value=""/>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <input class="btn btn-default" type="submit" value="{{trans('games.edit.send')}}">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @endpermission
    </div>
@endsection