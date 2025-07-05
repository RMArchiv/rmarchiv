@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card">
                    <form method="POST" action="{{action('SearchController@search')}}" class="form-horizontal" >
                        @csrf
                    <div class="card-header">
                        {{ trans('app.search') }}
                    </div>
                    <div class="card-body">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 col-form-label">{{ trans('app.search') }}</label>
                                <div class="col-lg-10">
                                    @if(isset($term))
                                        <input class="d-none form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' value="{{ $term }}" />
                                    @else
                                        <input class="d-none form-control" id="inputEmail" autocomplete="off" type='text' name='term' size='64' placeholder="{{ trans('app.search') }}" />
                                    @endif
                                    <div class="searchbar"></div>
                                </div>
                            </div>
                            <script type="module">
                                createAutocomplete({
                                    apiPath: ()=>{return "ac_search_new"},
                                    placeholder: "{{ trans('app.search') }}",
                                    searchbarSelector:".searchbar",
                                    noResults:'{{ trans('app.search_nothing_found') }}',
                                    type:"games",
                                    action:"navigate",
                                    inputSelector:"#inputEmail",
                                    limit:5,
                                    additionalProps:{}
                                });
                            </script>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    </form>
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