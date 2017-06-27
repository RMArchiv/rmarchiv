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
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $list->title }}
                </div>
                <div class="panel-body">
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