@extends('layouts.app')
@section('pagetitle', trans('app.edit_game'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>
                        @if($game->subtitle)
                            {{ $game->title }}
                            <small> - {{ $game->subtitle }}</small> {{ trans('app.edit') }}
                        @else
                            {{ $game->title }} {{ trans('app.edit') }}
                        @endif

                    </h1>
                    {!! Breadcrumbs::render('game-edit', $game) !!}
                </div>
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
            <div class="col-md-12">
                <div class="card form">
                    <div class="card-header">
                        Grundinformationen
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="col-lg-2 col-form-label">{{trans('app.gametitle')}} *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-lg-2 col-form-label">{{trans('app.gamesubtitle')}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="title" name="subtitle" value="{{ $game->subtitle }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for='maker' class="col-lg-2 col-form-label">{{trans('app.maker')}} *</label>
                            <div class="col-lg-10">
                                <select name='maker' id='maker' class="form-control">
                                    <option value="0">{{trans('app.choose_maker')}}</option>
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
                            <label class="col-lg-2 col-form-label" for='language'>{{trans('app.language')}} *</label>
                            <div class="col-lg-10">
                                <select name='language' id='language' class="form-control">
                                    <option value="0">{{trans('app.choose_language')}}</option>
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
                            <label class="col-lg-2 col-form-label" for="releasedate_day">{{trans('app.release_date')}}</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    @php $reldate = \Carbon\Carbon::parse($game->release_date) @endphp
                                    <select name="releasedate_day" id="releasedate_day" class="form-control">
                                        <option value="0">{{trans('app.release_date_day')}}</option>
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
                                        <option value="0">{{trans('app.release_date_month')}}</option>
                                        @for($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}"
                                                    @if($reldate->month == $i and $reldate->year != -1)
                                                    selected="selected"
                                                    @endif
                                            >{{ trans('app.month.'.$i) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="releasedate_year" id="releasedate_year" class="form-control">
                                        <option value="0">{{trans('app.release_date_year')}}</option>
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
                            <label for="atelier_id" class="col-lg-2 col-form-label">{{trans('app.atelier_id')}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="atelier_id" name="atelier_id" value="{{ $game->atelier_id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="makerpendium_article" class="col-lg-2 col-form-label">{{trans('Makerpendium Article URL')}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="makerpendium_article" name="makerpendium_article" value="{{ $game->makerpendium_article }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for='license' class="col-lg-2 col-form-label">{{trans('app.license')}} *</label>
                            <div class="col-lg-10">
                                <select name='license' id='license' class="form-control">
                                    <option value="0">{{trans('app.choose_license')}}</option>
                                    @foreach($licenses as $maker)
                                        @if($game->license_id == $maker->id)
                                            <option selected="selected" value="{{ $maker->id }}">{{ $maker->title }}</option>
                                        @else
                                            <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        {{trans('app.description')}}
                    </div>
                    <div class="card-body">
                        @include('_partials.markdown_editor', ['edit_text' => $game->desc_md])
                    </div>

                    <div class="card-header">
                        {{trans('app.links')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="websiteurl" class="col-lg-2 col-form-label">{{trans('app.website')}} *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="websiteurl" name="websiteurl" value="{{ $game->website_url }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="youtube" class="col-lg-2 col-form-label">{{ trans('app.trailer') }} *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="youtube" name="youtube"  placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8" value="{{ $game->youtube }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type="submit" value="{{trans('app.submit')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        {{trans('app.developers')}}
                    </div>
                    <div class="card-body">
                        <div class="form-horizontal">
                            @foreach($game->developers as $dev)
                                <div id="row_dev_{{ $dev->developer->id }}">
                                    {!! Form::open(['method' => 'POST', 'route' => ['games.developer.delete', $game->id]]) !!}
                                    {!! Form::hidden('devid', $dev->developer->id) !!}
                                    {!! Form::label($dev->id, $dev->developer->name) !!}
                                    {!! Form::submit(trans('app.delete'),['name' => $dev->developer->id, 'class' => 'btn btn-secondary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-header">
                        {{trans('app.add_developer')}}
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'POST', 'route' => ['games.developer.store', $game->id]]) !!}
                        <div class="form-group" id="row_developer">
                            <label for="developer" class="col-lg-2 col-form-label">{{trans('app.developer')}}</label>
                            <div class="col-lg-10">
                                <input autocomplete="off" type="text" class="auto form-control" id="developer" name="developer" value="">
                            </div>
                        </div>
                        <input class="btn btn-secondary" type="submit" value="{{trans('app.submit')}}">

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
                                        '{{trans('app.developer_not_found')}}',
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
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.added_tags') }}
                    </div>
                    <ul class="list-group">
                        @foreach($game->tags as $t)
                            <li class="list-group-item">
                                {{ $t->tag->title }}
                                <div class="badge">
                                    <a class="btn btn-secondary btn-xs" href="{{ action('TaggingController@delete_gametag', [$game->id, $t->tag->id]) }}">{{trans('app.delete')}}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        {{trans('app.user_credits')}}
                    </div>
                    <ul class="list-group">
                        @foreach($game->credits as $credit)
                            <li class="list-group-item">
                                <a class='usera' href='{{ url('users', $credit->user_id) }}' title="{{ $credit->user->name }}">
                                    <img alt="{{ $credit->user->name }}" class='avatar' src='//{{ config('app.avatar_path') }}?gender=male&id={{ $credit->user_id }}'>
                                </a>
                                <span class='prod'><a href='{{ url('users', $credit->user_id) }}' class='user'>{{ $credit->user->name }}</a></span>
                                - {{ $credit->type->title }}
                                <div class="badge">
                                    <a class="btn btn-secondary btn-xs" href="{{ action('UserCreditsController@destroy', [$game->id, $credit->id]) }}">{{trans('app.delete')}}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-header">
                        {{trans('app.add_credits')}}
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'POST', 'route' => ['gamecredits.store', $game->id], 'class' => 'form-horizontal']) !!}
                        <div class="form-group" id="row_user">
                            <label for="user" class="col-lg-2 col-form-label">{{trans('app.username')}}:</label>
                            <div class="col-lg-10">
                                <input autocomplete="off" class="auto form-control" name="user" id="user" placeholder="{{trans('app.username')}}" value=""/>
                            </div>
                        </div>
                        <div class="form-group" id="row_credittype">
                            <label for="credit" class="col-lg-2 col-form-label">{{trans('app.credits_type')}}:</label>
                            <div class="col-lg-10">
                                <select name='credit' id='credit' class="form-control">
                                    <option value="0">{{trans('app.choose_credits_type')}}</option>
                                    @foreach(\App\Models\UserCreditType::get() as $ct)
                                        <option value="{{ $ct->id }}">{{$ct->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input class="btn btn-secondary" type="submit" value="{{trans('app.submit')}}">
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
                                        '{{trans('app.user_not_found')}}',
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
        </div>
        @permission(('delete-games'))
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    {!! Form::open(['method' => 'POST', 'route' => ['games.invisible', $game->id]]) !!}
                    <div class="card-header">
                        {{ __('Invisible on Start Page') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="row_invisible">
                            <label for="invisible" class="col-lg-2 col-form-label">{{ __('Unsichtbar auf Startseite') }}:</label>
                            <div class="col-lg-10">
                                <select name='invisible' id='invisible' class="form-control">
                                    @if($game->invisible_on_start_page == 1)
                                        <option value="0">Sichtbar</option>
                                        <option selected="selected" value="1">Unsichtbar</option>
                                    @else
                                        <option selected="selected" value="0">Sichtbar</option>
                                        <option value="1">Unsichtbar</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-secondary" type="submit" value="{{trans('app.submit')}}">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    {!! Form::open(['method' => 'DELETE', 'route' => ['games.destroy', $game->id]]) !!}
                    <div class="card-header">
                        {{trans('app.delete_game')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="confirm" class="col-lg-2 col-form-label">{{trans('app.enter_confirm_plus_id')}}</label>
                            <div class="col-lg-10">
                                <input class="form-control" name="confirm" id="confirm" placeholder="CONFIRM+1014" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-secondary" type="submit" value="{{trans('app.submit')}}">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endpermission
    </div>
@endsection