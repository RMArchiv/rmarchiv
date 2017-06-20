@extends('layouts.app')
@section('content')
    <div id="content">
        @if(Auth::check())
            @if(isset($request) == false)
                {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                    {!! Form::hidden('step', 2) !!}
                    <h2>{{ trans('resources.create.title') }}</h2>
                    <div class="content">
                        <div class="formifier">
                            <div class='row' id='row_type'>
                                <label for='type'>{{ trans('resources.create.type') }}</label>
                                <select name='type' id='type'>
                                    <option value="0">{{ trans('resources.create.type_choose') }}</option>
                                    <option value="gfx">{{ trans('resources.create.gfx') }}</option>
                                    <option value="sfx">{{ trans('resources.create.sfx') }}</option>
                                    <option value="scripts">{{ trans('resources.create.scripts') }}</option>
                                    <option value="tools">{{ trans('resources.create.tools') }}</option>
                                </select>
                                <span>[<span class="req">req</span>]</span>
                            </div>
                        </div>
                    </div>

                    <div class="foot">
                        <input type="submit" value="{{ trans('resources.create.next') }}">
                    </div>
                </div>
                {!! Form::close() !!}
            @else
                @if($request->get('step') == 2)
                    {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                    <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                        {!! Form::hidden('step', 3) !!}
                        {!! Form::hidden('type', $request->get('type')) !!}
                        <h2>{{ trans('resources.create.step') }} -> {{ $request->get('type') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                <div class='row' id='row_cat'>
                                    <label for='cat'>{{ trans('resources.create.category') }}:</label>
                                    <select name='cat' id='cat'>
                                        <option value="0">{{ trans('resources.create.category_choose') }}</option>
                                        @if($request->get('type') == 'gfx')
                                            <option value="autotiles">{{ trans('resources.create.autotiles') }}</option>
                                            <option value="backdrop">{{ trans('resources.create.backdrops') }}</option>
                                            <option value="battle">{{ trans('resources.create.battle') }}</option>
                                            <option value="battlecharset">{{ trans('resources.create.battlecharset') }}</option>
                                            <option value="battleweapon">{{ trans('resources.create.battleweapon') }}</option>
                                            <option value="charset">{{ trans('resources.create.charset') }}</option>
                                            <option value="chipset">{{ trans('resources.create.chipset') }}</option>
                                            <option value="faceset">{{ trans('resources.create.faceset') }}</option>
                                            <option value="gameover">{{ trans('resources.create.gameovers') }}</option>
                                            <option value="monster">{{ trans('resources.create.monster') }}</option>
                                            <option value="panorama">{{ trans('resources.create.panorama') }}</option>
                                            <option value="pictures">{{ trans('resources.create.pictures') }}</option>
                                            <option value="title">{{ trans('resources.create.titles') }}</option>
                                            <option value="transition">{{ trans('resources.create.transition') }}</option>
                                            <option value="system">{{ trans('resources.create.system') }}</option>
                                        @elseif($request->get('type') == 'gfx')
                                            <option value="music">{{ trans('resources.create.music') }}</option>
                                            <option value="sounds">{{ trans('resources.create.sounds') }}</option>
                                        @elseif($request->get('type') == 'scripts')
                                            <option value="rm2k">{{ trans('resources.create.rm2k') }}</option>
                                            <option value="rm2k3">{{ trans('resources.create.rm2k3') }}</option>
                                            <option value="rmxp">{{ trans('resources.create.rmxp') }}</option>
                                            <option value="rmvx">{{ trans('resources.create.rmvx') }}</option>
                                            <option value="rmmv">{{ trans('resources.create.rmmv') }}</option>
                                        @elseif($request->get('type') == 'tools')
                                            <option value="rtp">{{ trans('resources.create.rtp') }}</option>
                                            <option value="audio">{{ trans('resources.create.audio') }}</option>
                                            <option value="video">{{ trans('resources.create.video') }}</option>
                                            <option value="gfx">{{ trans('resources.create.gfx') }}</option>
                                            <option value="text">{{ trans('resources.create.text') }}</option>
                                            <option value="misc">{{ trans('resources.create.misc') }}</option>
                                        @endif
                                    </select>
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                            </div>
                        </div>

                        <div class="foot">
                            <input type="submit" value="{{ trans('resources.create.next') }}">
                        </div>
                    </div>
                    {!! Form::close() !!}
                @elseif($request->get('step') == 3)
                    {!! Form::open(['url' => 'resources/create', 'method' => 'post']) !!}
                    <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                        {!! Form::hidden('step', 4) !!}
                        {!! Form::hidden('type', $request->get('type')) !!}
                        {!! Form::hidden('cat', $request->get('cat')) !!}
                        <h2>{{ trans('resources.create.step') }} -> {{ $request->get('type') }} -> {{ $request->get('cat') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                <div class='row' id='row_title'>
                                    <label for='title'>{{ trans('resources.create.res_title') }}:</label>
                                    <input type="text" name="title" id="title">
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                                <div class="row" id="row_desc">
                                    <label for="desc">{{ trans('resources.create.desc') }}:</label>
                                    <textarea name="desc" id="desc" maxlength="4000" rows="10" placeholder="{{ trans('resources.create.desc') }}"></textarea>
                                </div>
                                <script type="text/javascript">
                                    $(function() {
                                        $('textarea').inlineattachment({
                                            uploadUrl: 'http://rmarchiv.de/attachment/upload',
                                        });
                                    });
                                </script>
                                <div class='row' id='row_type'>
                                    <label for='content_type'>{{ trans('resources.create.content_type') }}</label>
                                    <select name='content_type' id='content_type'>
                                        <option value="0">{{ trans('resources.create.content_type_choose') }}</option>
                                        <option value="url">{{ trans('resources.create.url') }}</option>
                                        <option value="audio">{{ trans('resources.create.audio') }}</option>
                                        <option value="video">{{ trans('resources.create.video') }}</option>
                                        <option value="image">{{ trans('resources.create.image') }}</option>
                                        <option value="archive">{{ trans('resources.create.archive') }}</option>
                                    </select>
                                    <span>[<span class="req">req</span>]</span>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <input type="submit" value="{{ trans('resources.create.next') }}">
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
                        <h2>{{ trans('resources.create.step') }} -> {{ $request->get('type') }} -> {{ $request->get('cat') }}</h2>
                        <div class="content">
                            <div class="formifier">
                                @if($request->get('content_type') == 'url')
                                    <div class='row' id='row_url'>
                                        <label for='url'>{{ trans('resources.create.url') }}:</label>
                                        <input type="text" name="url" id="url" placeholder="http://www.blablubb.de">
                                        <span>[<span class="req">req</span>]</span>
                                    </div>
                                @else
                                    <div class="row" id="row_file">
                                        <label for="fine-uploader">{{trans('app.upload_file')}}:</label>
                                        <div id="fine-uploader"></div>
                                        <span>[<span class="req">req</span>]</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="foot">
                            <input type="submit" value="{{ trans('resources.create.send') }}">
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