@extends('layouts.app')
@section('pagetitle', trans('maker.title'))
@section('content')
    <div id='content'>
        <h2>{{ trans('maker.show.gamesfor') }}: "{{ $games->first()->maker->title }}"</h2>
        @include('_partials.tables.game_table', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ])
    </div>
@endsection