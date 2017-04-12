@extends('layouts.app')
@section('pagetitle', 'spiel anlegen')
@section('content')
    @permission(('create-games'))
    <div id="content">
        {!! Form::open(['action' => ['GameController@store']]) !!}
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>{{trans('app.games.add.success.title')}}</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

            <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                <h2>{{trans('games.create.title')}}</h2>

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_title">
                            <label for="title">{{trans('games.create.gametitle')}}</label>
                            <input name="title" id="title" placeholder="Anno 1602" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_subtitle">
                            <label for="subtitle">{{trans('games.create.subtitle')}}</label>
                            <input name="subtitle" id="subtitle" placeholder="Erschaffung einer neuen Welt" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_maker'>
                            <label for='maker'>{{trans('games.create.maker')}}</label>
                            <select name='maker' id='maker'>
                                <option value="0">{{trans('games.create.maker_choose')}}</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_language'>
                            <label for='language'>{{trans('games.create.language')}}</label>
                            <select name='language' id='language'>
                                <option value="0">{{trans('games.create.language_choose')}}</option>
                                @foreach($langs as $lang)
                                    <option value="{{ $lang->short }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_atelier_id">
                            <label for="atelier_id">{{ trans('games.create.atelierid') }}</label>
                            <input name="atelier_id" id="atelier_id" placeholder="820" value=""/>
                        </div>
                    </div>
                </div>

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