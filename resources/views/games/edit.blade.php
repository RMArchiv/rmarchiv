@extends('layouts.app')
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
            <h2>bearbeiten eines Spiels</h2>

            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_title">
                        <label for="title">spieltitel</label>
                        <input name="title" id="title" value="{{ $game->gametitle }}"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_subtitle">
                        <label for="subtitle">untertitel:</label>
                        <input name="subtitle" id="subtitle" value="{{ $game->gamesubtitle }}"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class='row' id='row_maker'>
                        <label for='maker'>erstellt mit:</label>
                        <select name='maker' id='maker'>
                            <option value="0">bitte maker version auswählen</option>
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
                        <label for='language'>sprache:</label>
                        <select name='language' id='language'>
                            <option value="0">bitte sprache des spiels auswählen</option>
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

            <h2>Beschreibungstext ändern/hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_desc">
                        <label for="desc">Beschreibung:</label>
                        <textarea name="desc" id="desc" maxlength="2000" rows="10" placeholder="Beschreibung des Spiels (2000 Zeichen)">{{ $game->gamedescmd }}</textarea>
                    </div>
                </div>
            </div>

            <h2>Links</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_websiteurl">
                        <label for="websiteurl">website:</label>
                        <input name="websiteurl" id="websiteurl" placeholder="https://www.anno1602.de" value="{{ $game->websiteurl }}"/>
                    </div>
                </div>
            </div>

            <div class="foot">
                <input type="submit" value="senden">
            </div>
        </div>
        {!! Form::close() !!}

        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>Verbundene entwickler</h2>
            <div class="content">
                <div class="formifier">
                    @foreach($developers as $dev)
                    <div class="row" id="row_dev_{{ $dev->devid }}">
                        {!! Form::open(['method' => 'POST', 'route' => ['games.developer.delete', $game->gameid]]) !!}
                        {!! Form::hidden('devid', $dev->devid) !!}
                        {!! Form::label($dev->devid, $dev->devname) !!}
                        {!! Form::submit('löschen',['name' => $dev->devid]) !!}
                        {!! Form::close() !!}
                    </div>
                    @endforeach
                </div>
            </div>

        {!! Form::open(['method' => 'POST', 'route' => ['games.developer.store', $game->gameid]]) !!}
            <h2>entwickler zum spiel hinzufügen</h2>
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
                            return '<p><strong>' + data.value + '</strong></p>';
                        }
                    }
                });
            </script>
            <div class="foot">
                <input type="submit" value="senden">
            </div>
        {!! Form::close() !!}
        </div>
    </div>
@endsection