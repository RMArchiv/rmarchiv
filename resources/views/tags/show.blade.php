@extends('layouts.app')
@section('pagetitle', 'tag: '. $tag->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $tag->title }}</h1>
                    {!! Breadcrumbs::render('tag', $tag) !!}
                </div>
            </div>
        </div>
        <div class="row">
            @include('_partials.tables.game_table', [
                'id' => $tag->id,
                'games' => $games,
                'orderby' => $orderby,
                'direction' => $direction,
            ])
        </div>
    </div>
@endsection