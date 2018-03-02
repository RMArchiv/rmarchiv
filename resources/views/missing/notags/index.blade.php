@extends('layouts.app')
@section('pagetitle', trans('app.games_without_tags'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.games_without_tags') }}</h1>
                    {!! Breadcrumbs::render('missing.tags') !!}
                </div>
            </div>
        </div>
        <div class="row">
            @include('_partials.tables.game_table', [
                'games' => $games,
                'orderby' => $orderby,
                'direction' => $direction,
            ])
        </div>
    </div>
@endsection