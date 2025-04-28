@extends('layouts.app')
@section('pagetitle', trans('app.add_game_to_award'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.add_game_to_award') }} {{ $award->awardpage->title .': '. $award->title .' - '. $award->year . ' ' . trans('app.month.'. $award->month) }}</h1>
                    {!! Breadcrumbs::render('awards.gameadd', $subcatid) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
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
                {!! Form::open(['action' => ['AwardController@gameadd_store']]) !!}
                <input name="subcatid" type="hidden" value="{{ $subcatid }}">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.add_game_to_award') }}
                    </div>
                    <div class="card-body">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group" id="row_game">
                                    <label for="game">{{ trans('app.gametitle') }} *</label>
                                    <input autocomplete="off" class="auto form-control" name="game" id="game" placeholder="{{ trans('app.gametitle') }}" value=""/>
                                    <script type="module">
                                        addSearch({
                                            targetQuery: "#row_game .auto",
                                            apiPath: "ac_games",
                                            emptyTemplate: [
                                                '<div style="color: #00001a;">',
                                                '{{trans('app.game_not_found')}}',
                                                '</div>'
                                            ].join('\n'),
                                            name: "game",
                                            display: "id",
                                            limit: 9,
                                            suggestionFunction: (data) => return '<p><strong>' + data.value + '</strong></p>';
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="place">{{ trans('app.place') }} *</label>
                                    <input autocomplete="off" class="form-control" name="place" id="place" placeholder="1" value=""/>
                                </div>
                                <div class="form-group">
                                    <label for="desc">{{ trans('app.description') }}</label>
                                    <input autocomplete="off" class="form-control" name="desc" id="desc" placeholder="123 points" value=""/>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{{trans('app.submit')}}">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection