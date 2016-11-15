@extends('layouts.app')
@section('content')
    <div id="content">
        {!! Form::open(['action' => ['GameController@store']]) !!}
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>spiel hinzufügen</h2>
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
                <h2>Eintragen eines Spiels</h2>

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
                                <option value="0">bitte maker version auswählen</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class='row' id='row_language'>
                            <label for='language'>sprache:</label>
                            <select name='language' id='language'>
                                <option value="0">bitte sprache des spiels auswählen</option>
                                @foreach($langs as $lang)
                                    <option value="{{ $lang->short }}">{{ $lang->name }}</option>
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
                        <div class="row" id="row_websiteurl">
                            <label for="websiteurl">url youtube trailer:</label>
                            <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value=""/>
                        </div>
                    </div>
                </div>

                <h2>Verbindungen</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_developer">
                            <label for="developer">entwickler name:</label>
                            <input autocomplete="off" class="auto" name="developer" id="developer" placeholder="Einfach Entwicklernamen eintippen" value=""/>
                            <span> [<span class="req">req</span>] <br>hier wird erstmal nur der hauptenwickler eingetragen. <br>weitere entwickler können später hinzugefügt werden.</span>
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