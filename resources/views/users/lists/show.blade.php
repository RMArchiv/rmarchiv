@extends('layouts.app')
@section('pagetitle', trans('app.userlist_of').': '.$list->user->name.' - '.$list->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.userlist_of') }}: {{ $list->user->name }} - {{ $list->title }}</h1>
                    {!! Breadcrumbs::render('userlist.show', $list->user, $list) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ $list->title }}
                    </div>
                    <div class="card-body">
                        {!! Markdown::convertToHtml($list->desc_md) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($games as $game)
            <div>
                <div class="px-3 card d-flex flex-row justify-content-between gap-4 align-items-center">
                    <div>
                        @include('_partials.tables.game_table_row', [
                            'game' => $game,
                        ])
                    </div>
                    <div class="h-100">
                        @if(Auth::id() == $list->user_id)
                        <a title={{trans('app.delete_game')}} href="{{ action('UserListController@delete_game', [$list->id,$game->id]) }}" class="btn btn-secondary fa fa-minus d-flex justify-content-center"></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection