@extends('layouts.app')
@section('pagetitle', trans('app.edit_gamefile'))
@section('content')
    @if(Auth::check())
        {!! Form::open(['action' => ['GameFileController@update', $gamefile->game_id, $gamefile->id]]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{trans('app.edit_gamefile')}}</h2>

            <div class="content">
                {{ trans('app.edit_gamefile_infos') }}
                <div class="formifier">
                    <div class='row' id='row_filetype'>
                        <label for='filetype'>{{trans('app.release_type')}}</label>
                        <select name='filetype' id='filetype'>
                            <option value="0">{{trans('app.choose_release_type')}}</option>
                            @foreach($filetypes as $types)
                                <option @if ($gamefile->release_type == $types->id) selected="" @endif value="{{ $types->id }}">{{ $types->title }}</option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_version">
                        <label for="version">{{trans('app.gamefile_version')}}</label>
                        <input name="version" id="version" value="{{ $gamefile->release_version }}" placeholder="1.0" />
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_releasedate">
                        <label for="releasedate">{{trans('app.release_date')}}</label>
                        <div class="formdate" id="releasedate">
                            <select name="releasedate_day" id="releasedate_day">
                                <option value="0">{{trans('app.release_date_day')}}</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option @if ($gamefile->release_day == $i) selected="" @endif value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_month" id="releasedate_month">
                                <option value="0">{{trans('app.release_date_month')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option @if ($gamefile->release_month == $i) selected="" @endif value="{{ $i }}">{{ trans('app.month.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_year" id="releasedate_year">
                                <option value="0">{{trans('app.release_date_year')}}</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option @if ($gamefile->release_year == $i) selected="" @endif value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_file">
                        <label for="fine-uploader">{{trans('app.upload_file')}}:</label>
                        <div id="fine-uploader"></div>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    @if(Auth::user()->hasRole(['admin', 'owner']))
                        <div class="row" id="row_forbidden">
                            <label for="forbidden">{{ trans('app.delete_gamefile') }}</label>
                            <input name="forbidden" id="forbidden" value="" placeholder="{{ trans('app.delete_gamefile_reason') }}" />
                        </div>
                    @endif
                </div>
            </div>

            <div class="foot">
                <input type="submit" value="{{ trans('app.submit') }}">
            </div>
        </div>
        {!! Form::close() !!}
    @endif


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
                    endpoint: "/games/"+ {{ $gamefile->game_id }} +"/gamefiles/upload"
                }
            },
            resume: {
                enabled: true
            },
            request: {
                endpoint: "/games/"+ {{ $gamefile->game_id }} +"/gamefiles/upload",
                customHeaders: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            multiple: false,
            deleteFile: {
                enabled: true,
                endpoint: "/games/"+ {{ $gamefile->game_id }} +"/gamefiles/upload"
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