<?php

namespace App\Helpers;

class CheckRateable {
    public static function checkRateable($content_type, $content_id, $user_id) {
        $up = 0;
        $down = 0;

        $comments = \DB::table('comments')
            ->selectRaw("SUM(comments.vote_up) as up, SUM(comments.vote_down) as down")
            ->where('comments.content_id', '=', $content_id)
            ->where('comments.content_type', '=', $content_type)
            ->where('comments.user_id', '=', $user_id)
            ->first();

        if ($comments->up > 0 || $comments->down > 0) {
            return false;
        }else {
            return true;
        }
    }
}