@extends('layouts.app')
@section('content')
    <div id="content">
        @if(Auth::check())
            @if(isset($request) == false)
                {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                    {!! Form::hidden('step', 2) !!}
                    <h2>hinzufügen einer ressource</h2>
                    <div class="content">
                        <div class="formifier">
                            <div class='row' id='row_type'>
                                <label for='type'>resourcen typ:</label>
                                <select name='type' id='type'>
                                    <option value="0">bitte ressourcentyp auswählen</option>
                                    <option value="gfx">grafik</option>
                                    <option value="sfx">audio</option>
                                    <option value="scripts">scripts</option>
                                    <option value="tools">tools</option>
                                </select>
                                <span>[<span class="req">req</span>]</span>
                            </div>
                        </div>
                    </div>

                    <div class="foot">
                        <input type="submit" value="weiter">
                    </div>
                </div>
                {!! Form::close() !!}
            @else
                @if($request->get('step') == 2)
                    {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                    <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                        {!! Form::hidden('step', 3) !!}
                        {!! Form::hidden('type', $request->get('type')) !!}
                        <h2>hinzufügen einer ressource -> {{ $request->get('type') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                <div class='row' id='row_cat'>
                                    <label for='cat'>resourcen kategorie:</label>
                                    <select name='cat' id='cat'>
                                        <option value="0">bitte resourcenkategorie auswählen</option>
                                        @if($request->get('type') == 'gfx')
                                            <option value="autotiles">autotiles</option>
                                            <option value="backdrop">backdrops</option>
                                            <option value="battle">battle animations</option>
                                            <option value="battlecharset">battle charsets</option>
                                            <option value="battleweapon">battleweapons</option>
                                            <option value="charset">charsets</option>
                                            <option value="chipset">chipsets</option>
                                            <option value="faceset">facesets</option>
                                            <option value="gameover">gameovers</option>
                                            <option value="monster">monster</option>
                                            <option value="panorama">panoramas</option>
                                            <option value="pictures">pictures</option>
                                            <option value="title">titles</option>
                                            <option value="transition">transitions</option>
                                            <option value="system">windowskins</option>
                                        @elseif($request->get('type') == 'gfx')
                                            <option value="music">music</option>
                                            <option value="sounds">sounds</option>
                                        @elseif($request->get('type') == 'scripts')
                                            <option value="rm2k">rm2k scripts</option>
                                            <option value="rm2k3">rm2k3 scripts</option>
                                            <option value="rmxp">rmxp scripts</option>
                                            <option value="rmvx">rmvx scripts</option>
                                            <option value="rmmv">rmmv scripts</option>
                                        @elseif($request->get('type') == 'tools')
                                            <option value="rtp">runtime packages</option>
                                            <option value="audio">audio</option>
                                            <option value="video">video</option>
                                            <option value="gfx">grafik</option>
                                            <option value="text">text</option>
                                            <option value="misc">sonstiges</option>
                                        @endif
                                    </select>
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                            </div>
                        </div>

                        <div class="foot">
                            <input type="submit" value="weiter">
                        </div>
                    </div>
                    {!! Form::close() !!}
                @elseif($request->get('step') == 3)
                    {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                    <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                        {!! Form::hidden('step', 4) !!}
                        {!! Form::hidden('type', $request->get('type')) !!}
                        {!! Form::hidden('cat', $request->get('cat')) !!}
                        <h2>hinzufügen einer ressource -> {{ $request->get('type') }} -> {{ $request->get('cat') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                <div class='row' id='row_title'>
                                    <label for='title'>titel:</label>
                                    <input type="text" name="title" id="title">
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                                <div class="row" id="row_desc">
                                    <label for="desc">beschreibung::</label>
                                    <textarea name="desc" id="desc" maxlength="4000" rows="10" placeholder="hier kommt die ressourcenbeschreibung rein"></textarea>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('textarea').inlineattachment({
                                                uploadUrl: 'http://rmarchiv.de/attachment/upload',
                                            });
                                        });
                                    </script>
                                </div>
                                <div class='row' id='row_type'>
                                    <label for='content_type'>content typ:</label>
                                    <select name='content_type' id='content_type'>
                                        <option value="0">bitte content typ auswählen</option>
                                        <option value="url">url</option>
                                        <option value="audio">audio</option>
                                        <option value="video">video</option>
                                        <option value="image">image</option>
                                        <option value="archive">archiv (zip/rar)</option>
                                    </select>
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <input type="submit" value="weiter">
                        </div>
                    </div>
                    {!! Form::close() !!}

                @elseif($request->get('step') == 4)
                    {!! Form::open(['url' => 'resources/create/store', 'method' => 'post']) !!}
                    <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                        {!! Form::hidden('step', 5) !!}
                        {!! Form::hidden('type', $request->get('type')) !!}
                        {!! Form::hidden('cat', $request->get('cat')) !!}
                        {!! Form::hidden('title', $request->get('title')) !!}
                        {!! Form::hidden('desc', $request->get('desc')) !!}
                        {!! Form::hidden('content_type', $request->get('content_type')) !!}
                        <h2>hinzufügen einer ressource -> {{ $request->get('type') }} -> {{ $request->get('cat') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                @if($request->get('content_type') == 'url')
                                    <div class='row' id='row_url'>
                                        <label for='url'>url:</label>
                                        <input type="text" name="url" id="url" placeholder="http://www.blablubb.de">
                                        <span>[<span class="req">req</span>]</span>
                                    </div>
                                @else
                                    <div class="row" id="row_file">
                                        <label for="fine-uploader">{{trans('app.misc.upload_file')}}:</label>
                                        <div id="fine-uploader"></div>
                                        <span>[<span class="req">req</span>]</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="foot">
                            <input type="submit" value="senden">
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
            @endif
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
                    endpoint: "/resources/upload",
                }
            },
            resume: {
                enabled: true
            },
            request: {
                endpoint: "/resources/upload",
                customHeaders: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            multiple: false,
            deleteFile: {
                enabled: true,
                endpoint: "/resources/upload",
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