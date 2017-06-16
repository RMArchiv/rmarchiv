@extends('layouts.app')
@section('pagetitle', 'spieldateien: '.$game->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>spieldateien</h1>
                {!! Breadcrumbs::render('gamefiles.add', $game) !!}
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="row">
                <h2>{{trans('app.games.gamefiles.title')}}</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    vorhandene spieldateien: {{ $gamefiles->count() }}
                </div>
                <ul class="list-group">
                    @foreach($gamefiles as $gf)
                        <li class="list-group-item clearfix">
                            <span class='typeiconlist'>
                                <span class='typei type_{{ $gf->gamefiletype->short }}' title='{{ $gf->gamefiletype->title }}'>{{ $gf->gamefiletype->title }}</span>
                            </span>
                            <span> • </span><span>version: {{ $gf->release_version }}</span>
                            <span> • </span>
                            <span>release date: {{ str_pad($gf->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->release_day, 2, 0, STR_PAD_LEFT) }}</span>
                            <span> • </span>
                            <span>size: {{ ByteUnits\Metric::bytes($gf->filesize)->format() }}</span>
                            <span> • </span>
                            <span>downloads: {{ $gf->downloadcount or 0 }}</span>
                            <span> • </span>
                            <span>
                                <a href="{{ url('/user', $gf->user->id) }}" class="usera" title="{{ $gf->user->name }}">
                                    <img width="16px" src="http://ava.rmarchiv.de/?gender=male&amp;id={{ $gf->user->id }}" alt="{{ $gf->user->name }}" class="avatar">
                                </a> <a href="{{ url('/user', $gf->user->id) }}" class="user">{{ $gf->user->name }}</a>
                            </span>
                            <span> • </span>
                            <span>{{ $gf->filecreated_at }}</span>
                            <div class="pull-right">
                                <div class="button-group">
                                    @if(Auth::check() and !$gf->deleted_at)
                                        @if($gf->forbidden == 1)
                                            [
                                            <span class="button" title="{{ $gf->reason }}">{{trans('games.gamefiles.download_deleted')}}</span>]
                                        @else
                                            [
                                            <a href="{{ url('games/download', $gf->id) }} " class="down_l">{{trans('games.gamefiles.download')}}</a>]
                                            @php
                                                $playable = \App\Models\PlayerIndexjson::whereGamefileId($gf->id)->get();
                                            @endphp
                                            @if($playable->count() != 0 )
                                                :: [<a href="{{ route('player.run', [$gf->id]) }}">play</a>]
                                            @endif
                                        @endif
                                        :: [
                                        <a href="{{ route('gamefiles.edit', [$game->id, $gf->id]) }}">{{trans('games.gamefiles.edit')}}</a>]
                                        @if(Auth::user()->settings->is_admin)
                                            :: [
                                            <a href="{{ route("gamefiles.delete", [$game->id, $gf->id]) }}">{{trans('games.gamefiles.delete')}}</a>]
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if(Auth::check())
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('games.gamefiles.gamefile_add')}}
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['gamefiles.store', $game->id], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <label for="filetype" class="col-sm-2 control-label">{{trans('games.gamefiles.type')}}: *</label>
                            <div class="col-sm-10">
                                <select class="form-control" name='filetype' id='filetype'>
                                    <option value="0">{{trans('games.gamefiles.type_choose')}}</option>
                                    @foreach($filetypes as $types)
                                        <option value="{{ $types->id }}">{{ $types->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="version" class="col-sm-2 control-label">{{trans('games.gamefiles.fileversion')}}: *</label>
                            <div class="col-sm-10">
                                <input name="version" id="version" value="" placeholder="1.0" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-inline form-group">
                            <label for="releasedate" class="col-sm-2 control-label">{{trans('games.gamefiles.release_date')}}</label>
                            <div class="col-sm-10">
                                <select name="releasedate_day" id="releasedate_day" class="form-control">
                                    <option value="0">{{trans('games.gamefiles.release_day')}}</option>
                                    @for($i = 1; $i < 32; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="releasedate_month" id="releasedate_month" class="form-control">
                                    <option value="0">{{trans('games.gamefiles.release_month')}}</option>
                                    @for($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ trans('_misc.month.'.$i) }}</option>
                                    @endfor
                                </select>
                                <select name="releasedate_year" id="releasedate_year" class="form-control">
                                    <option value="0">{{trans('games.gamefiles.release_year')}}</option>
                                    @for($i = 1990; $i < date("Y") + 1; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fine-uploader" class="col-sm-2 control-label">{{trans('games.gamefiles.upload_file')}}:</label>
                            <div class="col-sm-10">
                                <div id="fine-uploader"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">{{ trans('games.gamefiles.send') }}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                     class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>{{ trans('games.gamefiles.upload_file') }}</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                    <span>Processing dropped files...</span>
                    <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                </span>
            <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite"
                aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                             class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon"
                                  aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>
    <script>
        var uploader = new qq.FineUploader({
            debug: true,
            autoUpload: true,
            element: document.getElementById('fine-uploader'),
            chunking: {
                enabled: false,
                concurrent: {
                    enabled: true
                },
                success: {
                    endpoint: "/games/" + {{ $game->id }}+"/gamefiles/upload"
                }
            },
            resume: {
                enabled: true
            },
            request: {
                endpoint: "/games/" + {{ $game->id }}+"/gamefiles/upload",
                customHeaders: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            multiple: false,
            deleteFile: {
                enabled: true,
                endpoint: "/games/" + {{ $game->id }}+"/gamefiles/upload"
            },
            retry: {
                enableAuto: true
            },
            text: {
                uploadButton: 'Datei wählen'
            },
            callbacks: {
                onComplete: function (id, fileName, responseJSON) {
                    if (responseJSON.success) {
                        $('#fine-uploader').append('<input type="hidden" name="uuid" value="' + responseJSON.uuid + '">');
                        $('#fine-uploader').append('<input type="hidden" name="filename" value="' + responseJSON.uploadName + '">');
                        $('#fine-uploader').append('<input type="hidden" name="ext" value="' + responseJSON.ext + '">');
                    }
                }
            }
        });
    </script>

@endsection