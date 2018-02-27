@extends('layouts.app')
@section('pagetitle', trans('app.savegame_manager'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.savegame_manager') }}</h1>
                    {!! Breadcrumbs::render('savegamemanager.index') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.list_with_savegames_newest_on_top') }}
                    </div>
                    <ul class="list-group">
                        @foreach($games as $g)
                            <li class="list-group-item">
                                <div class="pull-right">
                                <span class="badge">
                                    {{ \App\Models\GamesSavegame::whereUserId(Auth::id())->where('gamefile_id', '=', $g->gamefile_id)->get()->count() }} {{ trans('app.savegames') }}
                                </span>
                                </div>
                                <a href="{{ action('SavegameManagerController@show', [$g->gamefile->id]) }}">
                                <span class="typeiconlist">
                                    <span class="typei type_{{ $g->gamefile->gamefiletype->short }}" title="{{$g->gamefile->gamefiletype->title}}">{{ $g->gamefile->gamefiletype->title }}</span>
                                </span>
                                    <span class="platformiconlist">
                                    <span class="typei type_{{ $g->gamefile->game->maker->short }}" title="{{ $g->gamefile->game->maker->title }}">
                                        {{ $g->gamefile->game->maker->title }}
                                    </span>
                                </span>
                                    {{ $g->gamefile->game->title }}
                                    @if($g->gamefile->game->subtitle)
                                        -
                                        <small>{{ $g->gamefile->game->subtitle }}</small>
                                    @endif
                                    -
                                    {{ $g->gamefile->release_version }}
                                </a>

                                <span class="text-muted"> :: {{ trans('app.last_savegame') }} {{ \Carbon\Carbon::parse($g->updated_at)->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection