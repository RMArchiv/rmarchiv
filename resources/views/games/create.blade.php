@extends('layouts.app')
@section('content')
    <div id="content">
        {!! Form::open(['action' => ['CommentController@add']]) !!}
            <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                <h2>Eintragen eines Spiels</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.news.add.error.title') }}</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_title">
                            <label for="title">spieltitel</label>
                            <input name="title" id="title" placeholder="Anno 1602" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_subtitle">
                            <label for="subtitle">untertitel:</label>
                            <input name="subtitle" id="subtitle" placeholder="Erschaffung einer neuen Welt" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_maker'>
                            <label for='maker'>erstellt mit:</label>
                            <select name='maker' id='maker'>
                                <option>Bitte Maker version auswhählen</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>

                <h2>Beschreibungstext ändern/hinzufügen</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_desc">
                            <label for="desc">Beschreibung:</label>
                            <textarea name="desc" id="desc" maxlength="2000" rows="10" placeholder="Beschreibung des Spiels (2000 Zeichen)"></textarea>
                        </div>
                    </div>
                </div>

                <h2>Links</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_yttrailer">
                            <label for="yttrailer">url youtube trailer:</label>
                            <input name="yttrailer" id="yttrailer" placeholder="https://www.youtube.com/watch?v=Wh_1966vaIA" value=""/>
                        </div>
                    </div>
                </div>

                <h2>Verbindungen</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_developer">
                            <label for="developer">entwickler name:</label>
                            <input autocomplete="off" class="auto" name="developer" id="developer" placeholder="Einfach Entwicklernamen eintippen" value=""/>
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
                                'Noch wurde nichts gefunden.',
                                '</div>'
                            ].join('\n'),
                            suggestion: function(data) {
                                console.log(data);
                                return '<p><strong>' + data.value + '</strong> – ' + data.id + '</p>';
                            }
                        }
                    });
                </script>

                <div class="foot">
                    <input type="submit" value="senden">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection