@extends('layouts.app')
@section('pagetitle', 'maker')
@section('content')
    <div id='content'>
        <h2>spiele für den "{{ $games->first()->maker->title }}"</h2>
        @include('_partials.tables.game_table', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ])
    </div>
@endsection