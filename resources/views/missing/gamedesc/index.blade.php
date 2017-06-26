@extends('layouts.app')
@section('pagetitle', trans('app.missing_gamedescriptions'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.missing_gamedescriptions') }}</h1>
                {!! Breadcrumbs::render('missing.gamedesc') !!}
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