@extends('layouts.app')
@section('pagetitle', 'Coup de coeur hinzufügen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Coup de coeur hinzufügen</h1>
                    {!! Breadcrumbs::render('cdc.create') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Fehler!</h4>
                            <p>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="well form-horizontal" action="{{ url('cdc') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            Coup de coeur hinzufügen
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="gamename">
                                <label for="gamename" class="col-lg-2 col-form-label">Spiel</label>
                                <input type="text" class="auto form-control" name="gamename" id="gamename">
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
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Senden</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection