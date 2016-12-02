@extends('layouts.app')
@section('pagetitle', 'coup de coeur hinzufügen')
@section('content')
    <div id="content">
        <form action="{{ url('cdc') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_cdc">
                <h2>coup de coeur hinzufügen</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>coup de coeur nicht hinzugefügt</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_name">
                            <label for="gamename">Spiel:</label>
                            <input class="auto" name="gamename" id="gamename" value=""/>
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
                            url: '/ac_games/%QUERY',
                            wildcard: '%QUERY'
                        }
                    });

                    $('#row_name .auto').typeahead(null, {
                        name: 'gamename',
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
                    <input type="submit" value="{{ trans('app.misc.send') }}">
                </div>
            </div>
        </form>
    </div>
@endsection