<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class TestController extends Controller
{
    use Helpers;

    public function __construct()
    {
        // Only apply to a subset of methods.
        $this->middleware('api.auth', ['only' => ['show']]);
    }

    public function show()
    {
        \Debugbar::disable();

        return 1;
    }

    public function index()
    {
        return 'index';
    }
}
