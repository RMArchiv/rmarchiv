<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use PhpBinaryReader\BinaryReader;
use Illuminate\Support\Str;

class PlayerHelper
{
    public static function getSavegameValidation($data)
    {
        $br = new BinaryReader($data);

        $br->setPosition(0);

        $datalength = $br->readInt8();
        $returned = $br->readString($datalength);

        if ($returned == 'LcfSaveData') {
            return true;
        } else {
            return false;
        }
    }

    public function getZipRootPath($zipfilepath)
    {
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

        $mapparray = [];
        for ($i = 0; $i < 2000; $i++) {
            $mapparray[] = 'map'.sprintf('%04d', $i).'.lmu';
        }

        $filearray = array_merge($rootarray, $mapparray);

        $searcharray = array_merge($dirarray, $filearray);

        if ($this->starts_with_array(strtolower($zipfilepath), $searcharray)) {
            $imp = str_replace('/', '\\/', $zipfilepath);
        } else {
            if (Str::contains(strtolower($zipfilepath), $searcharray)) {
                $exp = explode('/', $zipfilepath);
                $res = array_shift($exp);
                $imp = implode('/', $exp);
                $imp = $this->getZipRootPath($imp);
            } else {
                $imp = '';
            }
        }

        if ($imp != '') {
            if (array_search(strtolower($imp), $filearray)) {
                $imp = '.\\/'.$imp;
            }
        }

        return $imp;
    }

    private function starts_with_array($string, array $arr){
        foreach ($arr as $a){
            if(str_starts_with($string, $a)){
                return true;
            }else{
                return false;
            }
        }
    }
}
