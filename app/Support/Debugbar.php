<?php

namespace App\Support;

class Debugbar
{
    public static function disable()
    {
        if (class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) {
            return \Barryvdh\Debugbar\Facades\Debugbar::disable();
        }

        return null;
    }

    public static function __callStatic($method, $arguments)
    {
        if (class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) {
            return \Barryvdh\Debugbar\Facades\Debugbar::$method(...$arguments);
        }

        return null;
    }
}
