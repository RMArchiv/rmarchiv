@extends('layouts.app')
@section('pagetitle', 'spiel anlegen')
@section('content')
    @permission(('create-games'))
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>{{trans('games.create.title')}}</h1>
                    {!! Breadcrumbs::render('game-add') !!}
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
            <div class="row">
                {!! Form::open(['action' => ['GameController@store']]) !!}
                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>grundinformationen</legend>
                            <div class="form-group">
                                <label for="title" class="col-lg-2 control-label">{{trans('games.create.gametitle')}} *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Anno 1997">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subtitle" class="col-lg-2 control-label">{{trans('games.create.subtitle')}} *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Erschaffung einer neuen Welt">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='maker' class="col-lg-2 control-label">{{trans('games.create.maker')}} *</label>
                                <div class="col-lg-10">
                                    <select name='maker' id='maker' class="form-control">
                                        <option value="0">{{trans('games.create.maker_choose')}}</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='form-group' id='row_language'>
                                <label class="col-lg-2 control-label" for='language'>{{trans('games.create.language')}} *</label>
                                <select name='language' id='language' class="form-control">
                                    <option value="0">{{trans('games.create.language_choose')}}</option>
                                    @foreach($langs as $lang)
                                        <option value="{{ $lang->short }}">{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="atelier_id" class="col-lg-2 control-label">{{trans('games.create.atelierid')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="atelier_id" name="atelier_id" placeholder="1337">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>


    <div id="content">
            <div class="rmarchivtbl" id="rmarchivbox_submitprod">

                <h2>{{trans('games.create.gamedescription')}}</h2>
                <div class="content">
                    @include('_partials.markdown_editor')

                </div>

                <h2>{{trans('games.create.links')}}</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_websiteurl">
                            <label for="websiteurl">{{trans('games.create.game_website')}}</label>
                            <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value=""/>
                        </div>
                        <div class="row" id="row_youtube">
                            <label for="youtube">{{ trans('games.create.trailer') }}</label>
                            <input name="youtube" id="youtube" placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8" value=""/>
                        </div>
                    </div>
                </div>

                <h2>{{trans('games.create.connections')}}</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_developer">
                            <label for="developer">{{trans('games.create.developer')}}</label>
                            <input autocomplete="off" class="auto" name="developer" id="developer" placeholder="{{trans('games.create.developer')}}" value=""/>
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
                                '{{trans('games.create.not_found')}}',
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
                    <input type="submit" value="{{trans('games.create.send')}}">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    @else
        @include('_partials.accessdenied')
    @endpermission
@endsection