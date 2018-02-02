@extends('layouts.app')
@section('pagetitle', trans('app.userlist_of').': '.$list->user->name.' - '.$list->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.userlist_of') }}: {{ $list->user->name }} - {{ $list->title }}</h1>
                {!! Breadcrumbs::render('userlist.show', $list->user, $list) !!}
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    {{ $list->title }}
                </div>
                <div class="card-body">
                    {!! Markdown::convertToHtml($list->desc_md) !!}
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