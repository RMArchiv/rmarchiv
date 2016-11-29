<?php

namespace App\Helpers;

class MiscHelper{
    public static function getPopularity($views, $max){

        $ret = 0;

        if($max == 0 or $views == 0){
            $ret = 0;
        }else{
            $ret = ($views / $max) * 100;
        }

        return $ret;
    }
}