@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_search'>
            <h2>suche</h2>
            {{ Form::open(['action' => ['SearchController@search']]) }}
                <div class='content center'>
                    @if(isset($term))
                        <input id="term" autocomplete="off" type='text' name='term' size='64' value="{{ $term }}" />
                    @else
                        <input id="term" autocomplete="off" type='text' name='term' size='64' placeholder="Suche" />
                    @endif

                    <script>
                        $("#term").typeahead({
                            highlight: true,
                            hint: true,
                            minLength: 1
                        });
                    </script>
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' />
                </div>
            {{ Form::close() }}
        </div>
        <script type="text/javascript">
            var sourcepath = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                //prefetch: '../data/films/post_1960.json',
                remote: {
                    url: '/ac_search/%QUERY',
                    wildcard: '%QUERY'
                }
            });

            $('#term').typeahead(null, {
                name: 'term',
                display: 'title',
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
                        return data.value;
                    }
                },
                classNames: {
                    menu: 'search_menu',
                }
            });
        </script>
        @if(isset($term))
        <h3>suche nach: '{{ $term }}' - nach relevanz</h3><br>
        @endif

        @if(isset($games))
        <h2>spiele</h2>
            <div id='content'>
                <h2>games</h2>
                @include('_partials.tables.game_table', [
                    'games' => $games,
                    'orderby' => $orderby,
                    'direction' => $direction,
                ])
            </div>
        @endif
    </div>


@endsection