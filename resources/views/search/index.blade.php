@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    @if(isset($term))
                        {{ trans('app.search') }}: '{{ $term }}' - nach relevanz
                    @else
                        {{ trans('app.search') }}
                    @endif
                </h1>
                {!! Breadcrumbs::render('search') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card">
                    {{ Form::open(['action' => ['SearchController@search'], 'class' => 'form-horizontal']) }}
                    <div class="card-header">
                        {{ trans('app.search') }}
                    </div>
                    <div class="card-body">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 col-form-label">{{ trans('app.search') }}</label>
                                <div class="col-lg-10">
                                    @if(isset($term))
                                        <input class="form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' value="{{ $term }}" />
                                    @else
                                        <input class="form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' placeholder="{{ trans('app.search') }}" />
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
                                    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    {{ Form::close() }}
                </div>
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