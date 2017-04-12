@extends('layouts.app')
@section('pagetitle', 'games')
@section('content')
    <div id='content'>
        <h2>{{ trans('games.title') }}</h2>
        @include('_partials.tables.game_table', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ])
    </div>
@endsection