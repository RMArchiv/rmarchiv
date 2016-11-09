<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Developer;

class AutocompleteController extends Controller
{
    public function developer(){
        $term = Input::get('term');
        $result = array();

        if(strlen($term) >= 3){
            $devs = Developer::whereName($term)->get();

            foreach ($devs as $dev){
                $resilt[] = ['id' => $dev->id, 'value' => $dev->name];
            }

            return \Response::json($result);
        }
    }
}
