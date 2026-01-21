@extends('layouts.app')
@section('pagetitle', trans('app.gamefiles').': '.$game->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.gamefiles') }}</h1>
                    {!! Breadcrumbs::render('gamefiles.add', $game) !!}
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="row">
                <h2>{{trans('app.add_gamefiles')}}</h2>
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
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.gamefiles_count') }}: {{ $gamefiles->count() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('app.release_type') }}</th>
                                <th>{{ trans('app.language') }}</th>
                                <th>{{ trans('app.gamefile_version') }}</th>
                                <th>{{ trans('app.release_date') }}</th>
                                <th>Size</th>
                                <th>Downloads</th>
                                <th>Notes</th>
                                <th>Uploader</th>
                                <th>Hinzugefuegt</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gamefiles as $gf)
                                <tr>
                                    <td>
                                        <span class='typei type_{{ $gf->gamefiletype->short }}' title='{{ $gf->gamefiletype->title }}'>{{ $gf->gamefiletype->title }}</span>
                                    </td>
                                    <td>
                                        @if($gf->language)
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/assets/lng/16/{{ strtoupper($gf->language->short) }}.png" title="{{ $gf->language->name }}" alt="{{ $gf->language->name }}">
                                                <span>{{ $gf->language->name }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $gf->release_version }}</td>
                                    <td>{{ str_pad($gf->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->release_day, 2, 0, STR_PAD_LEFT) }}</td>
                                    <td>{{  @round($gf->filesize/1024/1024,2)." MiB" }}</td>
                                    <td>{{ $gf->downloadcount ?? 0 }}</td>
                                    <td class="text-break">{!! nl2br(e($gf->notes ?? '')) !!}</td>
                                    <td>
                                        <a href="{{ action('UserController@show', $gf->user->id) }}" class="usera" title="{{ $gf->user->name }}">
                                            <img width="16px" src="//{{ config('app.avatar_path') }}?gender=male&amp;id={{ $gf->user->id }}" alt="{{ $gf->user->name }}" class="avatar">
                                        </a>
                                        <a href="{{ action('UserController@show', $gf->user->id) }}" class="user">{{ $gf->user->name }}</a>
                                    </td>
                                    <td>{{ $gf->created_at }}</td>
                                    <td>
                                        @if($gf->forbidden == 1)
                                            <span class="d-block" title="{{ $gf->reason }}">{{ trans('app.download_deleted') }}</span>
                                            @if(Auth::check() && Auth::user()->hasRole(['admin', 'owner']))
                                                <a href="{{ action('GameFileController@restore', $gf->id) }}">Wiederherstellen</a>
                                            @endif
                                        @else
                                            <a href="{{ url('games/download', [$gf->id, time()]) }}" class="down_l">{{ trans('app.download') }}</a>
                                            @php
                                                $playable = \App\Models\PlayerIndexjson::whereGamefileId($gf->id)->get();
                                            @endphp
                                            @if(Auth::check() and !$gf->deleted_at)
                                                @if($playable->count() != 0)
                                                    <span class="mx-1">|</span><a href="{{ route('player.run', [$gf->id]) }}">{{ trans('app.play') }}</a>
                                                @endif
                                                <span class="mx-1">|</span><a href="{{ route('gamefiles.edit', [$game->id, $gf->id]) }}">{{ trans('app.edit') }}</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        @if(Auth::check())
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{trans('app.add_gamefile')}}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('gamefiles.store', $game->id) }}" class="form-horizontal">
                                @csrf
                            <div class="form-group">
                                <label for="filetype" class="col-sm-2 col-form-label">{{trans('app.release_type.title')}}: *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='filetype' id='filetype'>
                                        <option value="0">{{trans('app.choose_release_type')}}</option>
                                        @foreach($filetypes as $types)
                                            <option value="{{ $types->id }}">{{ $types->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="version" class="col-sm-2 col-form-label">{{trans('app.gamefile_version')}}: *</label>
                                <div class="col-sm-10">
                                    <input name="version" id="version" value="" placeholder="1.0" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-inline form-group">
                                <label for="releasedate" class="col-sm-2 col-form-label">{{trans('app.release_date')}}</label>
                                <div class="col-sm-10">
                                    <select name="releasedate_day" id="releasedate_day" class="form-control">
                                        <option value="0">{{trans('app.release_date_day')}}</option>
                                        @for($i = 1; $i < 32; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="releasedate_month" id="releasedate_month" class="form-control">
                                        <option value="0">{{trans('app.release_date_month')}}</option>
                                        @for($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}">{{ trans('app.month.'.$i) }}</option>
                                        @endfor
                                    </select>
                                    <select name="releasedate_year" id="releasedate_year" class="form-control">
                                        <option value="0">{{trans('app.release_date_year')}}</option>
                                        @for($i = 1990; $i < date("Y") + 1; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="language" class="col-sm-2 col-form-label">{{trans('app.language')}}: *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='language' id='language'>
                                        <option value="0">{{trans('app.choose_language')}}</option>
                                        @foreach(\App\Models\Language::all() as $lang)
                                            <option @if(old('language') == $lang->id) selected @endif value="{{ $lang->id }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="notes" id="notes" rows="4" placeholder="Zusatzinfos zu dieser Version">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fine-uploader" class="col-sm-2 col-form-label">{{trans('app.upload_file')}}:</label>
                                <div class="col-sm-10">
                                    <div id="fine-uploader"></div>
                                    <div id="fine-uploader-error"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-secondary">{{ trans('app.submit') }}</button>
                            </form>
                        </div>
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
                <div>{{ trans('app.upload_file') }}</div>
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
                    <button type="button" class="qq-cancel-button-selector">{{ trans('app.close') }}</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">{{ trans('app.no') }}</button>
                    <button type="button" class="qq-ok-button-selector">{{ trans('app.yes') }}</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">{{ trans('app.cancel') }}</button>
                    <button type="button" class="qq-ok-button-selector">{{ trans('app.ok') }}</button>
                </div>
            </dialog>
        </div>
    </script>
    <script type="module">
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
                onError: function(id, name, errorReason, xhrOrXdr) {
                    if(xhrOrXdr.status === 413) {
                        $('#fine-uploader-error').html('{{trans("app.413_error")}}')
                    }
                },
                onComplete: function (id, fileName, responseJSON) {
                    console.log(responseJSON)
                    if (responseJSON.success) {
                        $('#fine-uploader-error').html('')
                        $('#fine-uploader').append('<input type="hidden" name="uuid" value="' + responseJSON.uuid + '">');
                        $('#fine-uploader').append('<input type="hidden" name="filename" value="' + responseJSON.uploadName + '">');
                        $('#fine-uploader').append('<input type="hidden" name="ext" value="' + responseJSON.ext + '">');
                    }
                }
            }
        });
    </script>

@endsection
