@extends('layouts.app')
@section('pagetitle', 'spiele ohne tags')
@section('content')
    <div id='content'>
        <h2>spiele ohne tags</h2>
        @include('_partials.tables.game_table', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ])
    </div>
@endsection