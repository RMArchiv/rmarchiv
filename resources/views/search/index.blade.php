@extends('layouts.app')
@section('pagetitle', 'suche')
@section('content')
    <div id='content'>
        <div class='rmarchivtbl' id='rmarchivbox_search'>
            <h2>suche</h2>
            {{ Form::open(['action' => ['SearchController@search']]) }}
                <div class='content center'>
                    @if(isset($term))
                        <input type='text' name='term' size='64' value="{{ $term }}" />
                    @else
                        <input type='text' name='term' size='64' placeholder="Suche" />
                    @endif
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' />
                </div>
            {{ Form::close() }}
        </div>
        @if(isset($term))
        <h3>suche nach: '{{ $term }}' - nach relevanz</h3><br>
        @endif

        @if(isset($games))
        <h2>spiele</h2>
            <div id='content'>
                <h2>games</h2>
                @include('_partials.tables.game_table', [
                    'games' => $games,
                    'orderby' => $orderby,
                    'direction' => $direction,
                ])
            </div>
        @endif
    </div>


@endsection