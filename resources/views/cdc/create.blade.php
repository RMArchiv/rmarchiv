@extends('layouts.app')
@section('pagetitle', 'coup de coeur hinzufügen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>coup de coeur hinzufügen</h1>
                {!! Breadcrumbs::render('cdc.create') !!}
            </div>
        </div>
        @if (count($errors) > 0))
        <div class="row">
            <h2>coup de coeur nicht hinzugefügt</h2>
            <div class="content">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row">
            <form class="well form-horizontal" action="{{ url('cdc') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <fieldset>
                    <legend>cdc hinzufügen</legend>
                    <div class="form-group" id="gamename">
                        <label for="gamename" class="col-lg-2 control-label">Spiel</label>
                        <div class="col-lg-10">
                            <input type="text" class="auto form-control" name="gamename" id="gamename">
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

                        $('#gamename .auto').typeahead(null, {
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
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Senden</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection