<?php
/**
 * Created by PhpStorm.
 * User: mhering
 * Date: 25.04.2017
 * Time: 08:33
 */

include "vendor/autoload.php";

$test = explode('/','Backdrop/');

if($test[1] == ''){

}

$string = 'as/as/as/Map0099.lmu';

echo search_for_base_path($string);


function search_for_base_path($filepath){
    $dirarray = [
        'backdrop',
        'battle',
        'battle2',
        'battlecharset',
        'battleweapon',
        'charset',
        'chipset',
        'faceset',
        'frame',
        'gameover',
        'monster',
        'panorama',
        'picture',
        'system',
        'system2',
        'title',
        'music',
        'sound',
    ];

    $rootarray = [
        'harmony.dll',
        'rpg_rt.exe',
        'rpg_rt.ini',
        'rpg_rt.ldb',
        'rpg_rt.lmt',
        'rpg_rt.dat',
    ];

    $mapparray = array();
    for($i = 0; $i < 2000; $i++){
        $mapparray[] = 'map'.sprintf('%04d', $i).'.lmu';
    }

    $filearray = array_merge($rootarray, $mapparray);

    $searcharray = array_merge($dirarray, $filearray);

    if(starts_with(strtolower($filepath), $searcharray)){
        $imp = str_replace('/','\\/',$filepath);
    }else{
        $exp = explode('/', $filepath);
        $res = array_shift($exp);
        $imp = implode('/', $exp);
        $imp = search_for_base_path($imp);
    }

    if(starts_with($imp, $filearray)){
        $imp = '.\\/'.$imp;
    }

    return $imp;
}