<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [

    'characters' => '0123456789',

    'default'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
    ],

    'rmarchiv' => [
        'length'    => 6,
        'width'     => 160,
        'height'    => 46,
        'quality'   => 100,
        'lines'     => 6,
        'bgImage'   => false,
        'bgColor'   => '#17395C',
        'fontColors'=> ['#ffbf00', '#ffdf00', '#ffffe0', '#4E6F90', '#FF8888'],
        'contrast'  => 0,
        'sensitive' => true,
        'angle'     => 12,
        'invert'    => false,
    ],

    'flat'   => [
        'length'    => 6,
        'width'     => 160,
        'height'    => 46,
        'quality'   => 90,
        'lines'     => 6,
        'bgImage'   => false,
        'bgColor'   => '#ecf2f4',
        'fontColors'=> ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast'  => -5,
    ],

    'mini'   => [
        'length'    => 3,
        'width'     => 60,
        'height'    => 32,
    ],

    'inverse'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'sensitive' => true,
        'angle'     => 12,
        'sharpen'   => 10,
        'blur'      => 2,
        'invert'    => true,
        'contrast'  => -5,
    ],

];
