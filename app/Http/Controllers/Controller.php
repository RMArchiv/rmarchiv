<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Eusonlito\LaravelMeta\Meta;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //default title Meta Plugin
        \Meta::title('rmarchiv.tk :: your online rpgmaker resource');

        // Default Robots
        \Meta::set('robots', 'index,follow');
        \Meta::set('image', 'http://rmarchiv.tk/logo/def7cdf80a1dd01ea3ee297ed019a500.png');
    }
}
