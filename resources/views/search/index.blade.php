@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    @if(isset($term))
                        suche: '{{ $term }}' - nach relevanz
                    @else
                        suche
                    @endif
                </h1>
                {!! Breadcrumbs::render('search') !!}
            </div>
        </div>
        <div class="row">
            <div class="well">
                {{ Form::open(['action' => ['SearchController@search'], 'class' => 'form-horizontal']) }}
                    <fieldset>
                        <legend>suche</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">suche</label>
                            <div class="col-lg-10">
                                @if(isset($term))
                                    <input class="form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' value="{{ $term }}" />
                                @else
                                    <input class="form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' placeholder="suche" />
                                @endif
                                    <script>
                                        $("#inputEmail").typeahead({
                                            highlight: true,
                                            hint: true,
                                            minLength: 1
                                        });
                                    </script>
                            </div>
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

                            $('#inputEmail').typeahead(null, {
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
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">suchen</button>
                            </div>
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
        @if(isset($games))
            <div class="row">
                @include('_partials.tables.game_table', [
                    'games' => $games,
                    'orderby' => $orderby,
                    'direction' => $direction,
                ])
            </div>
        @endif
    </div>

@endsection