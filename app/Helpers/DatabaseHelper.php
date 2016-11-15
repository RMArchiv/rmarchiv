<?php

namespace App\Helpers;

use App\Models\Developer;

class DatabaseHelper{
    public static function langId_from_short($short){
        $lang = \DB::table('languages')
            ->select('id')
            ->where('short', '=', $short)
            ->first();

        if($lang){
            return $lang->id;
        }else{
            return 0;
        }

    }

    public static function developerId_from_developerName($developername){
        $dev = \DB::table('developer')
            ->select('id')
            ->where('name', '=', $developername)
            ->first();

        if($dev){
            return $dev->id;
        }else{
            return 0;
        }

    }

    public static function developer_add_and_get_developerId($developername){
        $d = new Developer;
        $d->name = $developername;
        $d->user_id = \Auth::id();
        $d->save();

        return $d->id;
    }
}