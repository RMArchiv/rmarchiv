<?php

namespace App\Helpers;

class MiscHelper {

    public static function array_diff_assoc_recursive($array1, $array2) {
        $difference = array();
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2[$key]) || !is_array($array2[$key])) {
                    $difference[$key] = $value;
                }else {
                    $new_diff = MiscHelper::array_diff_assoc_recursive($value, $array2[$key]);
                    if (!empty($new_diff))
                        $difference[$key] = $new_diff;
                }
            }else if (!array_key_exists($key, $array2) || $array2[$key] !== $value) {
                $difference[$key] = $value;
            }
        }
        return $difference;
    }


    public static function getPopularity($views, $max){

        $ret = 0;

        if($max == 0 || $views == 0){
            $ret = 0;
        } else{
            $ret = ($views / $max) * 100;
        }

        return $ret;
    }

    /**
     * @param integer $size
     */
    public static function getReadableBytes($size){
        $bytes = $size;

        if ($bytes == 0) {
                    return "0.00 B";
        }

        $s = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $e = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $e), 2).' '.$s[$e];
    }
}