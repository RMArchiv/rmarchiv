<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Developer;

class AutocompleteController extends Controller
{
    public function developer($term){
        $result = array();

        //$devs = Developer::whereName($term)->get();
        $devs = \DB::table('developer')
            ->select(['id', 'name'])
            ->where('developer.name', 'like', '%'.$term.'%')
            ->get();

        foreach ($devs as $dev){
            $result[] = ['id' => $dev->id, 'value' => $dev->name];
        }

        return \Response::json($result);
    }

    public function game($term){
        $result = array();

        $games = \DB::table('games')
            ->select([
                'id',
                'title',
                'subtitle'
            ])
            ->where('title', 'like', '%'.$term.'%')
            ->orWhere('subtitle', 'like', '%'.$term.'%')
            ->get();

        foreach($games as $g){
            if(is_null($g->subtitle)){
                $result[] = ['id' => $g->id, 'value' => $g->title];
            }else{
                $result[] = ['id' => $g->id, 'value' => $g->title.' -=- '.$g->subtitle];
            }

        }

        return \Response::json($result);
    }
}