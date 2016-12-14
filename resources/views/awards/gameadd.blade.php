@extends('layouts.app')
@section('content')
    <div class="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>spiel zu award hinzufügen</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::open(['action' => ['AwardController@gameadd_store']]) !!}
        <input name="subcatid" type="hidden" value="{{ $subcatid }}">
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>spiel zu auszeichnung hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_game">
                        <label for="game">spielname:</label>
                        <input autocomplete="off" class="auto" name="game" id="game" placeholder="game" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <script type="text/javascript">
                        var sourcepath = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            //prefetch: '../data/films/post_1960.json',
                            remote: {
                                url: '/ac_games/%QUERY',
                                wildcard: '%QUERY'
                            }
                        });

                        $('#row_game .auto').typeahead(null, {
                            name: 'game',
                            display: 'id',
                            source: sourcepath,
                            limit: 5,
                            templates: {
                                empty: [
                                    '<div style="color: #00001a;">',
                                    '{{trans('app.misc.nothing_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function(data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>'
                                }
                            }
                        });
                    </script>
                    <div class="row" id="row_place">
                        <label for="place">platz:</label>
                        <input autocomplete="off" class="auto" name="place" id="place" placeholder="place" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_desc">
                        <label for="desc">beschreibung:</label>
                        <input autocomplete="off" class="auto" name="desc" id="desc" placeholder="desc" value=""/>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection