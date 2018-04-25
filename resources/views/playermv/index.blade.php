@extends('layouts.app')
@section('pagetitle', trans('app.webplayer').': '.$game->title)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $game->title }} <small>{{ $game->subtitle }}</small></h1>
                    {!! Breadcrumbs::render('webplayer', $game, $gamefileid) !!}
                </div>
            </div>
        </div>
        <div id="mv-frame" class="row">
        </div>
    </div>

{!! $index !!}

    <script>
    // RPG MV API hook magic
    if (Graphics._createCanvas === undefined ||
        Graphics._updateCanvas === undefined ||
        Graphics.pageToCanvasX === undefined ||
        Graphics.pageToCanvasY === undefined) {
        alert("Graphic API hooking failed. Please report a bug!");
    } else {
        Graphics._createCanvas = function() {
            this._canvas = document.createElement('canvas');
            this._canvas.id = 'GameCanvas';
            this._updateCanvas();
            document.getElementById("mv-frame").appendChild(this._canvas);
        }

        Graphics._updateCanvas = function() {
            this._canvas.width = this._width;
            this._canvas.height = this._height;
            this._canvas.style.zIndex = 1;
        };

        Graphics.pageToCanvasX = function(x) {
            if (this._canvas) {
                return Math.round((x - this._canvas.getBoundingClientRect().left - window.scrollX) / this._realScale);
            } else {
                return 0;
            }
        };

        Graphics.pageToCanvasY = function(y) {
            if (this._canvas) {
                return Math.round((y - this._canvas.getBoundingClientRect().top - window.scrollY) / this._realScale);
            } else {
                return 0;
            }
        };
    };

    if (StorageManager.saveToWebStorage === undefined ||
        StorageManager.removeWebStorage === undefined ||
        StorageManager.loadFromWebStorage === undefined
        ) {
        alert("Savegame API hooking failed. Please report a bug!");
    } else {
        // Delete existing savedata
        for (i = 1; i <= 99; ++i) {
            StorageManager.removeWebStorage(i);
        }

        StorageManager.saveToWebStorageOrig = StorageManager.saveToWebStorage;

        // Request serverside saves on startup
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var obj = JSON.parse(xhr.responseText);
                    var globalInfo = [];
                    for (var property in obj) {
                        if (obj.hasOwnProperty(property)) {
                            var save = JSON.parse(obj[property]);
                            if (save["global"] !== undefined &&
                                save["save"] !== undefined) {
                                StorageManager.saveToWebStorageOrig(property, LZString.decompressFromBase64(save["save"]));
                                globalInfo[property] = JSON.parse(save["global"]);
                                DataManager.saveGlobalInfo(globalInfo);
                            }
                        }
                    }
                } else {
                    console.log('Error: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', "{{ url('/') }}" + '/savegames/{{ $gamefileid }}');
        xhr.send(null);

        // Save function
        StorageManager.saveToWebStorage = function(savefileId, json) {
            StorageManager.saveToWebStorageOrig(savefileId, json);
            var savedata = LZString.compressToBase64(json);
            if (savefileId > 0 && savefileId <= 99) {
                var globalInfo = DataManager.makeSavefileInfo();
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = true;
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status !== 200) {
                            console.log('Error: ' + xhr.status);
                        }
                    }
                };
                xhr.open('POST', "{{ url('/') }}" + '/savegames/{{ $gamefileid }}/' + savefileId);
                xhr.send(JSON.stringify({
                    "global": JSON.stringify(globalInfo),
                    "save": savedata
                }));
            }
        }
    }
    </script>

@endsection
