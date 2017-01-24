@extends('layouts.app')
@section('content')
    <div id="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
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
        @if($gamefiles->count() <> 0)
            <h2>Spieledateien von: <a href="{{ url('games', $gamefiles->first()->gameid) }}">{{ $gamefiles->first()->gametitle }}<small> {{ $gamefiles->first()->gamesubtitle }}</small></a></h2>
            <table id='pouetbox_prodlist' class='boxtable pagedtable'>
                <thead>
                <tr class='sortable'>
                    <th></th>
                    <th>{{trans('app.games.gamefiles.type')}}</th>
                    <th>{{trans('app.games.gamefiles.version')}}</th>
                    <th>{{trans('app.games.gamefiles.release_date')}}</th>
                    <th>{{trans('app.games.gamefiles.filesize')}}</th>
                    <th>{{trans('app.games.gamefiles.downloads')}}</th>
                    <th>{{trans('app.games.gamefiles.uploaded_by')}}</th>
                    <th>{{trans('app.games.gamefiles.uploaded_at')}}</th>
                    @if(Auth::check())
                        <th>{{trans('app.games.gamefiles.actions')}}</th>
                    @endif
                </tr>
                </thead>
                @foreach($gamefiles as $gf)
                <tr>
                    <td>
                        <span class='typeiconlist'>
                            <span class='typei type_{{ $gf->filetypeshort }}' title='{{ $gf->filetypetitle }}'>{{ $gf->filetypetitle }}</span>
                        </span>
                    </td>
                    <td>{{ $gf->filetypetitle }}</td>
                    <td>{{ $gf->fileversion }}</td>
                    <td>{{ str_pad($gf->fileyear, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->filemonth, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($gf->fileday, 2, 0, STR_PAD_LEFT) }}</td>
                    <td>{{ ByteUnits\Metric::bytes($gf->filesize)->format() }}</td>
                    <td>{{ $gf->downloadcount or 0 }}</td>
                    <td>
                        <a href="{{ url('/user', $gf->userid) }}" class="usera" title="{{ $gf->username }}">
                            <img src="http://ava.rmarchiv.de/?gender=male&amp;id={{ $gf->userid }}" alt="{{ $gf->username }}" class="avatar">
                        </a> <a href="{{ url('/user', $gf->userid) }}" class="user">{{ $gf->username }}</a>
                    </td>
                    <td>{{ $gf->filecreated_at }}</td>
                    @if(Auth::check() and !$gf->deleted_at)
                        <td>
                            @if($gf->forbidden == 1)
                                [<span title="{{ $gf->reason }}">download entfernt</span>]
                            @else
                                [<a href="{{ url('games/download', $gf->fileid) }}">{{trans('app.misc.download')}}</a>]
                            @endif
                            :: [<a href="{{ route('gamefiles.edit', [$gf->gameid, $gf->fileid]) }}">edit</a>]
                        @if(Auth::user()->settings->is_admin)
                            :: [<a href="{{ route("gamefiles.delete", [$gameid, $gf->fileid]) }}">{{trans('app.misc.delete')}}</a>]
                        @endif
                        </td>
                    @endif
                </tr>
                @endforeach
            </table>
        @else
            <h2>{{trans('app.games.gamefiles.no_files')}}</h2>
        @endif

        @if(Auth::check())
        {!! Form::open(['route' => ['gamefiles.store', $gameid]]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{trans('app.games.gamefiles.add_file')}}</h2>

            <div class="content">
                <div class="formifier">
                    <div class='row' id='row_filetype'>
                        <label for='filetype'>{{trans('app.games.gamefiles.filetype')}}</label>
                        <select name='filetype' id='filetype'>
                            <option value="0">{{trans('app.games.gamefiles.filetype_choose')}}</option>
                            @foreach($filetypes as $types)
                                <option value="{{ $types->id }}">{{ $types->title }}</option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_version">
                        <label for="version">{{trans('app.games.gamefiles.version2')}}</label>
                        <input name="version" id="version" value="" placeholder="1.0"/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_releasedate">
                        <label for="releasedate">{{trans('app.games.gamefiles.release_date2')}}</label>
                        <div class="formdate" id="releasedate">
                            <select name="releasedate_day" id="releasedate_day">
                                <option value="0">{{trans('app.games.gamefiles.day')}}</option>
                                @for($i = 1; $i < 32; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_month" id="releasedate_month">
                                <option value="0">{{trans('app.games.gamefiles.month')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ trans('app.misc.month.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="releasedate_year" id="releasedate_year">
                                <option value="0">{{trans('app.games.gamefiles.year')}}</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                        <div class="row" id="row_file">
                            <label for="fine-uploader">{{trans('app.misc.upload_file')}}:</label>
                            <div id="fine-uploader"></div>
                            <span>[<span class="req">req</span>]</span>
                        </div>
                </div>
            </div>

            <div class="foot">
                <input type="submit" value="senden">
            </div>
        </div>
        {!! Form::close() !!}
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
                    endpoint: "/games/"+ {{ $gameid }}+"/gamefiles/upload"
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
                endpoint: "/games/"+ {{ $gameid }}+"/gamefiles/upload"
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