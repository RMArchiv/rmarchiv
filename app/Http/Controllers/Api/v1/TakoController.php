<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\GamesFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TakoController extends Controller
{
    public function filelist() {
        $list = GamesFile::with('gamefiletype', 'game')->get(); //->take(5);

        return $list;
    }
}
