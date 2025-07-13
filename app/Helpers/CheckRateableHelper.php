<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

class CheckRateableHelper
{
    public static function checkRateable($content_type, $content_id, $user_id)
    {
        $up = \DB::table('comments')
            ->where('comments.content_id', '=', $content_id)
            ->where('comments.content_type', '=', $content_type)
            ->where('comments.user_id', '=', $user_id)
            ->where('deleted', '=', 0)
            ->sum("vote_up");
        $down = \DB::table('comments')
            ->where('content_id', '=', $content_id)
            ->where('content_type', '=', $content_type)
            ->where('user_id', '=', $user_id)
            ->where('deleted', '=', 0)
            ->sum("vote_down");
        if ($up > 0 || $down > 0) {
            return false;
        } else {
            return true;
        }
    }
}
