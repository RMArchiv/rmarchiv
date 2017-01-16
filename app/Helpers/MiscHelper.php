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

    public static function getReadableBytes($size){
        $bytes = $size;

        if ($bytes == 0)
            return "0.00 B";

        $s = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $e = floor(log($bytes, 1024));
        return round($bytes/pow(1024, $e), 2).' '.$s[$e];
    }
}