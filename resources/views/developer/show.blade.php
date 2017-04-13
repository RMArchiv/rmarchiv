@extends('layouts.app')
@section('pagetitle', trans('developer.show.title').': '. @$games->first()->developer->name)
@section('content')
    <div id='content'>
        <h1>{{ @$games->first()->developer->name }}</h1>
        {{--
        hinzugefügt am {{ $games->first()->developer->created_at }} von <a href='{{ url('users', $games->first()->developer->user->id) }}' class='user'>{{ $games->first()->developer->user->name }}</a> <a href='{{ url('users', $games->first()->developer->user->id) }}' class='usera' title="{{ $games->first()->developer->user->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $games->first()->developer->user->id }}' alt="{{ $games->first()->developer->user->name }}" class='avatar'/></a>
        --}}
        <br><br>
        @include('_partials.tables.game_table', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ])
    </div>
@endsection