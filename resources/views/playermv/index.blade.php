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
    <!-- RPG MV API hook magic -->
    if (Graphics._createCanvas === undefined ||
        Graphics._updateCanvas === undefined ||
        Graphics.pageToCanvasX === undefined ||
        Graphics.pageToCanvasY === undefined) {
        alert("Hooking failed. Please report a bug!");
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
    </script>

@endsection
