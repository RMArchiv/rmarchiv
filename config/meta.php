<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Limit title meta tag length
    |--------------------------------------------------------------------------
    |
    | To best SEO implementation, limit tags.
    |
    */

    'title_limit' => 70,

    /*
    |--------------------------------------------------------------------------
    | Limit description meta tag length
    |--------------------------------------------------------------------------
    |
    | To best SEO implementation, limit tags.
    |
    */

    'description_limit' => 200,

    /*
    |--------------------------------------------------------------------------
    | Limit image meta tag quantity
    |--------------------------------------------------------------------------
    |
    | To best SEO implementation, limit tags.
    |
    */

    'image_limit' => 5,

    /*
    |--------------------------------------------------------------------------
    | Available Tag formats
    |--------------------------------------------------------------------------
    |
    | A list of tags formats to print with each definition
    |
    */

    'tags' => ['Tag', 'MetaName', 'MetaProperty', 'TwitterCard'],
];
