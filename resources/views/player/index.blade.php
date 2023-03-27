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
        <div class="row">
            <style>
                :root {
                    --color-gray: hsl(0, 0%, 55%);
                    --controls-size: 10vh;
                }

                @media (orientation: landscape) {
                    :root {
                        --controls-size: 20vh;
                    }
                }

                html {
                    touch-action: none;
                }

                body {
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
                    margin: 0;
                    color: white;
                    background: black;
                }

                .unselectable {
                    -webkit-touch-callout: none;
                    -webkit-user-select: none;
                    user-select: none;
                }

                #status {
                    font-size: 1.5rem;
                    color: var(--color-gray);
                    text-align: center;
                }

                #controls {
                    position: relative;
                    text-align: right;
                    z-index: 10;
                }

                #controls button {
                    -webkit-appearance: button;
                    display: inline-flex;
                    background: transparent;
                    border: 0;
                    color: white;
                    font-family: inherit;
                    font-size: 1em;
                    line-height: inherit;
                    cursor: pointer;
                    padding: 0.5rem;
                }

                #controls svg {
                    pointer-events: none;
                }

                #canvas {
                    position: inherit;
                    /*top: 50%;*/
                    /*left: 50%;*/
                    /*width: 100%;*/
                    /*height: 100%;*/
                    border: 0;
                    image-rendering: pixelated;
                    image-rendering: crisp-edges;
                    /*transform: translate(-50%, -50%);*/
                }

                img#canvas {
                    object-fit: contain;
                }

                #dpad,
                #apad {
                    position: fixed;
                    bottom: 1rem;
                }

                #dpad {
                    left: 1rem;
                }

                #apad {
                    right: 1rem;
                }

                #dpad svg {
                    width: calc(2 * var(--controls-size));
                    height: calc(2 * var(--controls-size));
                    fill: var(--color-gray);
                }

                #dpad svg rect {
                    opacity: 0.4;
                }

                #apad > * {
                    width: var(--controls-size);
                    height: var(--controls-size);
                    background-color: var(--color-gray);
                    border-radius: 50%;
                }

                #apad > :last-child {
                    position: relative;
                    right: var(--controls-size);
                }

                #dpad path:not(.active),
                #apad > *:not(.active) {
                    opacity: 0.4;
                }
            </style>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-right" id="controls">
                            <button id="controls-fullscreen" class="unselectable">
                                <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M13.5 13.5H10m3.5 0V10m0 3.5l-4-4m.5-8h3.5m0 0V5m0-3.5l-4 4M5 1.5H1.5m0 0V5m0-3.5l4 4m-4 4.5v3.5m0 0H5m-3.5 0l4-4" stroke="currentColor"></path></svg>
                            </button>
                        </div>

                        EasyRPG Player Status:
                        <div id="status"></div>
                    </div>
                    <div class="card-body text-center">
                        <div id="viewport">
                            <canvas id="canvas" tabindex="-1" class="unselectable"></canvas>

                            <div id="dpad" class="unselectable">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                    <path id="dpad-up" data-key="ArrowUp" data-key-code="38" d="M48,5.8C48,2.5,45.4,0,42,0H29.9C26.6,0,24,2.4,24,5.8V24h24V5.8z" />
                                    <path id="dpad-right" data-key="ArrowRight" data-key-code="39" d="M66.2,24H48v24h18.2c3.3,0,5.8-2.7,5.8-6V29.9C72,26.5,69.5,24,66.2,24z" />
                                    <path id="dpad-down" data-key="ArrowDown" data-key-code="40" d="M24,66.3c0,3.3,2.6,5.7,5.9,5.7H42c3.3,0,6-2.4,6-5.7V48H24V66.3z" />
                                    <path id="dpad-left" data-key="ArrowLeft" data-key-code="37" d="M5.7,24C2.4,24,0,26.5,0,29.9V42c0,3.3,2.3,6,5.7,6H24V24H5.7z" />
                                    <rect id="dpad-center" x="24" y="24" width="24" height="24" />
                                </svg>
                            </div>

                            <div id="apad" class="unselectable">
                                <div id="apad-escape" data-key="Escape" data-key-code="27"></div>
                                <div id="apad-enter" data-key="Enter" data-key-code="13"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        This awesome and outstanding WebPlayer is created, actively maintained and provided by
                        <a href="https://easyrpg.org" target="_blank"><img src="/assets/easyrpg-logo.png"></a>
                    </div>
                </div>

                <script async type="text/javascript" src="/index.js"></script>

                <script>
                    const hasTouchscreen = window.matchMedia('(hover: none), (pointer: coarse)').matches;
                    const preventNativeKeys = ['ArrowUp', 'ArrowDown', 'ArrowRight', 'ArrowLeft', ' ', 'F12'];
                    const keys = new Map();
                    const keysDown = new Map();
                    const canvas = document.getElementById('canvas');
                    let lastTouchedId;

                    // Make EasyRPG player embeddable
                    canvas.addEventListener('mouseenter', () => window.focus());
                    canvas.addEventListener('click', () => window.focus());

                    // Handle clicking on the fullscreen button
                    document.querySelector('#controls-fullscreen').addEventListener('click', () => {
                        const viewport = document.getElementById('viewport');
                        if (viewport.requestFullscreen) {
                            viewport.requestFullscreen();
                        }
                    });

                    /**
                     * Simulate a keyboard event on the emscripten canvas
                     *
                     * @param {string} eventType Type of the keyboard event
                     * @param {string} key Key to simulate
                     * @param {number} keyCode Key code to simulate (deprecated)
                     */
                    function simulateKeyboardEvent(eventType, key, keyCode) {
                        const event = new Event(eventType, { bubbles: true });
                        event.key = key;
                        event.code = key;
                        // Deprecated, but necessary for emscripten somehow
                        event.keyCode = keyCode;
                        event.which = keyCode;

                        canvas.dispatchEvent(event);
                    }

                    /**
                     * Simulate a keyboard input from `keydown` to `keyup`
                     *
                     * @param {string} key Key to simulate
                     * @param {number} keyCode Key code to simulate (deprecated)
                     */
                    function simulateKeyboardInput(key, keyCode) {
                        simulateKeyboardEvent('keydown', key, keyCode);
                        window.setTimeout(() => {
                            simulateKeyboardEvent('keyup', key, keyCode);
                        }, 100);
                    }

                    /**
                     * Bind a node by a specific key to simulate on touch
                     *
                     * @param {*} node The node to bind a key to
                     * @param {string} key Key to simulate
                     * @param {number} keyCode Key code to simulate (deprecated)
                     */
                    function bindKey(node, key, keyCode) {
                        keys.set(node.id, { key, keyCode });

                        node.addEventListener('touchstart', event => {
                            event.preventDefault();
                            simulateKeyboardEvent('keydown', key, keyCode);
                            keysDown.set(event.target.id, node.id);
                            node.classList.add('active');
                        });

                        node.addEventListener('touchend', event => {
                            event.preventDefault();

                            const pressedKey = keysDown.get(event.target.id);
                            if (pressedKey && keys.has(pressedKey)) {
                                const { key, keyCode } = keys.get(pressedKey);
                                simulateKeyboardEvent('keyup', key, keyCode);
                            }

                            keysDown.delete(event.target.id);
                            node.classList.remove('active');

                            if (lastTouchedId) {
                                document.getElementById(lastTouchedId).classList.remove('active');
                            }
                        });

                        // Inspired by https://github.com/pulsejet/mkxp-web/blob/262a2254b684567311c9f0e135ee29f6e8c3613e/extra/js/dpad.js
                        node.addEventListener('touchmove', event => {
                            const { target, clientX, clientY } = event.changedTouches[0];
                            const origTargetId = keysDown.get(target.id);
                            const nextTargetId = document.elementFromPoint(clientX, clientY).id;
                            if (origTargetId === nextTargetId) return;

                            if (origTargetId) {
                                const { key, keyCode } = keys.get(origTargetId);
                                simulateKeyboardEvent('keyup', key, keyCode);
                                keysDown.delete(target.id);
                                document.getElementById(origTargetId).classList.remove('active');
                            }

                            if (keys.has(nextTargetId)) {
                                const { key, keyCode } = keys.get(nextTargetId);
                                simulateKeyboardEvent('keydown', key, keyCode);
                                keysDown.set(target.id, nextTargetId);
                                lastTouchedId = nextTargetId;
                                document.getElementById(nextTargetId).classList.add('active');
                            }
                        })
                    }


                    let gamepads = {};
                    const haveEvents = 'ongamepadonnected' in window;

                    function addGamepad(gamepad) {
                        gamepads[gamepad.index] = gamepad;
                        updateTouchControlsVisibility();
                    }

                    function removeGamepad(gamepad) {
                        delete gamepads[gamepad.index];
                        updateTouchControlsVisibility();
                    }

                    /** @returns {Gamepad[]} */
                    function getGamepads() {
                        var pads = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads() : []);
                        return pads;
                    }

                    function scanGamePads() {
                        var pads = getGamepads();
                        for (var i = 0; i < pads.length; i++) {
                            if (pads[i]) {
                                if (pads[i].index in gamepads) {
                                    gamepads[pads[i].index] = pads[i];
                                } else {
                                    addGamepad(pads[i]);
                                }
                            }
                        }
                    }

                    if (!haveEvents) {
                        setInterval(scanGamePads, 500);
                    }

                    window.addEventListener('gamepadconnected', function(e) {
                        addGamepad(e.gamepad);
                    });

                    window.addEventListener('gamepaddisconnected', function(e) {
                        removeGamepad(e.gamepad);
                    })

                    function updateTouchControlsVisibility() {
                        if (hasTouchscreen && Object.keys(gamepads).length === 0) {
                            for (const elem of document.querySelectorAll('#dpad, #apad')) {
                                elem.style.display = '';
                            }
                        } else {
                            // If we don't have a touch screen, OR any gamepads are connected...
                            for (const elem of document.querySelectorAll('#dpad, #apad')) {
                                // Hide the touch controls
                                elem.style.display = 'none';
                            }
                        }
                    }

                    // Bind all elements providing a `data-key` attribute with the
                    // given key on touch-based devices
                    if (hasTouchscreen) {
                        for (const button of document.querySelectorAll('[data-key]')) {
                            bindKey(button, button.dataset.key, button.dataset.keyCode);
                        }
                    } else {
                        // Prevent scrolling when pressing specific keys
                        window.addEventListener('keydown', event => {
                            if (preventNativeKeys.includes(event.key)) {
                                event.preventDefault();
                            }
                        });

                        canvas.addEventListener('contextmenu', event => {
                            event.preventDefault();
                            // simulateKeyboardInput('Escape', 27);
                        });

                        // canvas.addEventListener('click', () => {
                        //   simulateKeyboardInput('Enter', 13);
                        // });
                    }

                    updateTouchControlsVisibility();
                </script>
            </div>
        </div>
    </div>

@endsection
