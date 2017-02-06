<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\GamesFile;

class TakoController extends Controller
{
    public function filelist()
    {
        $list = GamesFile::with('gamefiletype', 'game')->get(); //->take(5);

        return $list;
    }
}
