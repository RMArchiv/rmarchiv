<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Screenshot;
use Illuminate\Http\Request;

class ScreenshotsController extends Controller
{
    public function get_screens($id)
    {
        $screens = Screenshot::whereGameId($id)->get();

        return $screens;
    }
}
