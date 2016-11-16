@extends('layouts.app')
@section('content')
    <div id="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>spieldateien</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        //Hier kommt noch die Tabelle mit den vorhandenen dateien rein.

        {!! Form::open(['route' => ['gamefiles.store', $gameid]]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>hinzufügen einer spieledatei</h2>

            <div class="content">
                <div class="formifier">
                    <div class='row' id='row_filetype'>
                        <label for='filetype'>dateityp:</label>
                        <select name='filetype' id='filetype'>
                            <option value="0">bitte wähle einen dateityp</option>
                            @foreach($filetypes as $types)
                                <option value="{{ $types->id }}">{{ $types->title }}</option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_version">
                        <label for="version">version:</label>
                        <input name="version" id="version" value="" placeholder="1.0"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_releasedate">
                        <label for="releasedate">release datum:</label>
                        <div class="formdate" id="releasedate">
                            <select name="releasedate_day" id="releasedate_day">
                                <option value="0">tag</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_month" id="releasedate_month">
                                <option value="0">monat</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ trans('app.misc.month.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_year" id="releasedate_year">
                                <option value="0">jahr</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_upload">
                        <div class="row" id="row_file">
                            <label for="fine-uploader">datei hochladen:</label>
                            <div id="fine-uploader"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="foot">
                <input type="submit" value="senden">
            </div>
        </div>
        {!! Form::close() !!}
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
                <div>Datei hochladen</div>
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
                    endpoint: "/games/"+ {{ $gameid }}+"/gamefiles"
                }
            },
            resume: {
                enabled: true
            },
            request: {
                endpoint: "/games/"+ {{ $gameid }}+"/gamefiles/upload",
                customHeaders: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            multiple: false,
            deleteFile: {
                enabled: true,
                endpoint: "/games/"+ {{ $gameid }}+"/gamefiles/delete"
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
                    }
                }
            }
        });
    </script>

@endsection