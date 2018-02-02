@extends('layouts.app')
@section('pagetitle', trans('app.savegames'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.savegames_for') }}: {{ $gamefile->game->title }}
                    <small>{{ $gamefile->game->subtitle }}</small>
                </h1>
                {!! Breadcrumbs::render('savegamemanager.show', $gamefile) !!}
            </div>
        </div>
        <div class="row">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    {{ trans('app.savegames') }}
                    <div class="pull-right">
                        <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target=".savegame-upload">{{ trans('app.upload') }}</button>
                    </div>
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
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".savegame-delete-{{ $s['id'] }}">{{ trans('app.delete') }}</button>
                                        <a href="{{ action('SavegameManagerController@download', $s['id']) }}" class="btn btn-secondary">{{ trans('app.download') }}</a>
                                        <a href="{{ action('PlayerController@index', $gamefile_id).'?load-game-id='.$s['slot'] }}" class="btn btn-primary">{{ trans('app.play_in_browser') }}</a>
                                    </div>
                                    <div class="media-body">
                                        Slot: {{ $s['slot'] }}<br>
                                        <strong>Name: {{ $s['data'][100]['char1_name']['data'] }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ trans('app.level') }}: {{ $s['data'][100]['char1_level']['data'] }}
                                            <span> • </span>
                                            {{ trans('app.hp') }}: {{ $s['data'][100]['char1_hp']['data'] }}
                                            <span> • </span>
                                            {{ trans('app.date') }}: {{ $s['date'] }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade savegame-delete-{{ $s['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <H2>{{ trans('app.delete_savegame') }}</H2>
                                            <h4>{{ trans('app.are_you_sure_to_delete_savegame') }}</h4>
                                            <a href="{{ action('SavegameManagerController@delete', $s['id']) }}" class="btn btn-secondary">{{ trans('app.delete') }}</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('app.close') }}</button>
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

    <div class="modal fade savegame-upload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    {!! Form::open(['action' => ['SavegameManagerController@store'], 'files' => true]) !!}
                    {!! Form::hidden('gamefile_id', $gamefile->id) !!}
                    <H2>{{ trans('app.upload_savegame') }}</H2>
                    <h4>{{ trans('app.upload_savegames_only_for_the_right_gameversion') }}</h4>
                    <label for="file">{{ trans('app.savegame') }}:</label>
                    <input name="file" id="file" type="file" value=""/>
                    <br>
                    <label for="slot">{{ trans('app.savegame_slot') }}:</label><br>
                    <select name="slot" id="slot">
                        @for($i = 1; $i <= 15; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <br>
                    <p class="text-danger">
                        {{ trans('app.attention_uploading_can_overwrite') }}
                    </p>
                    <br><br>
                    <button type="submit" class="btn btn-secondary">{{ trans('app.upload') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('app.close') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection