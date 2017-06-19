@extends('layouts.app')
@section('pagetitle', 'savegames')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Savegames für: {{ $gamefile->game->title }}
                    <small>{{ $gamefile->game->subtitle }}</small>
                </h1>
                {!! Breadcrumbs::render('savegamemanager.show', $gamefile) !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-header">

                </div>
                <ul class="media-list">
                    @foreach($savegames as $s)
                        <li class="media">
                            <div class="media-body active">
                                <div class="media">
                                    <span class="pull-left">
                                        <span class="facei face_{{ $s['data'][100]['char1_face']['img_idx']+1 }}" style="background-image: url({{ $s['data'][100]['char1_face']['url'] }})">faceset</span>
                                    </span>
                                    <div class="btn-group pull-right img-rounded" role="group">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".savegame-delete-{{ $s['id'] }}">löschen</button>
                                        <a href="{{ action('PlayerController@index', $gamefile_id) }}" class="btn btn-primary">play the game</a>
                                    </div>
                                    <div class="media-body">
                                        Slot: {{ $s['slot'] }}<br>
                                        <strong>Name: {{ $s['data'][100]['char1_name']['data'] }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            LEVEL: {{ $s['data'][100]['char1_level']['data'] }}
                                            <span> • </span>
                                            HP: {{ $s['data'][100]['char1_hp']['data'] }}
                                            <span> • </span>
                                            DATE: {{ $s['date'] }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade savegame-delete-{{ $s['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <H2>savegame löschen</H2>
                                            <h4>bist du sicher, das du dieses savegame löschen willst?</h4>
                                            <a href="{{ action('SavegameManagerController@delete', $s['id']) }}" class="btn btn-default">löschen</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">schließen</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection