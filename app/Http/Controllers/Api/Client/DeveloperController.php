<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function developers(){
        $developers = Developer::all()->get();
        $date = Developer::latest()->first()->created_at;

        $ret = [
            'date' => $date,
            'developers' => $developers
        ];

        return $ret;
    }
}
