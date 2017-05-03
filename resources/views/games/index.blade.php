@extends('layouts.app')
@section('pagetitle', trans('games.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('games.title') }}</h1>
                {!! Breadcrumbs::render('games') !!}
            </div>
        </div>
        <div class="row">
            <div class='col-md-12'>
                @include('_partials.tables.game_table', [
                    'games' => $games,
                    'orderby' => $orderby,
                    'direction' => $direction,
                ])
            </div>
        </div>
    </div>
@endsection