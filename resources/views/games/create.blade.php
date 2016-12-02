@extends('layouts.app')
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
                <h2>{{trans('app.games.add.title')}}</h2>

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_title">
                            <label for="title">{{trans('app.games.add.gametitle')}}</label>
                            <input name="title" id="title" placeholder="Anno 1602" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_subtitle">
                            <label for="subtitle">{{trans('app.games.add.subtitle')}}</label>
                            <input name="subtitle" id="subtitle" placeholder="Erschaffung einer neuen Welt" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_maker'>
                            <label for='maker'>{{trans('app.games.add.maker')}}</label>
                            <select name='maker' id='maker'>
                                <option value="0">{{trans('app.games.add.maker_choose')}}</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_language'>
                            <label for='language'>{{trans('app.games.add.language')}}</label>
                            <select name='language' id='language'>
                                <option value="0">{{trans('app.games.add.language_choose')}}</option>
                                @foreach($langs as $lang)
                                    <option value="{{ $lang->short }}">{{ $lang->name }}</option>
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
                            <textarea name="desc" id="desc" maxlength="2000" rows="10" placeholder="{{trans('app.games.add.description_help')}}"></textarea>
                        </div>
                    </div>
                </div>

                <h2>{{trans('app.games.add.links')}}</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_websiteurl">
                            <label for="websiteurl">{{trans('app.games.add.website')}}</label>
                            <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value=""/>
                        </div>
                    </div>
                </div>

                <h2>{{trans('app.games.add.connections')}}</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_developer">
                            <label for="developer">{{trans('app.games.add.developer')}}</label>
                            <input autocomplete="off" class="auto" name="developer" id="developer" placeholder="Einfach Entwicklernamen eintippen" value=""/>
                            <span> [<span class="req">req</span>] <br>{{trans('app.games.add.developer_help')}}</span>
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
                                'Noch wurde nichts gefunden.',
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
            </div>
        {!! Form::close() !!}
    </div>
    @else
        @include('_partials.accessdenied')
    @endpermission
@endsection