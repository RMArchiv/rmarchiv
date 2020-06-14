<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;

class MsgBoxController extends Controller
{
    public function submit_logo()
    {
        $msg = [
            'title'       => trans('app.msgbox.logo.title'),
            'msg'         => trans('app.msgbox.logo.msg'),
            'redirect'    => trans('app.msgbox.logo.redirect'),
            'redirect_to' => url('logo/vote'),
        ];

        return view('msgbox', $msg);
    }

    public function comment_add($type, $id)
    {
        $msg = [
            'title'    => trans('app.msgbox.comment.title'),
            'msg'      => trans('app.msgbox.comment.msg'),
            'redirect' => trans('app.msgbox.comment.redirect'),
        ];

        if ($type == 'news') {
            $msg['redirect_to'] = url('news', $id);
        } elseif ($type == 'game') {
            $msg['redirect_to'] = url('games', $id);
        } elseif ($type == 'resource') {
            $msg['redirect_to'] = route('resources.show', DatabaseHelper::getResourcePathArray($id));
        } elseif ($type == 'event') {
            $msg['redirect_to'] = action('EventController@show', $id);
        }

        return view('msgbox', $msg);
    }

    public function game_add($id)
    {
        $msg = [
            'title'       => trans('app.msgbox.game.title'),
            'msg'         => trans('app.msgbox.game.msg'),
            'redirect'    => trans('app.msgbox.game.redirect'),
            'redirect_to' => url('games', $id),
        ];

        return view('msgbox', $msg);
    }

    public function screenshot_add($gameid)
    {
        $msg = [
            'title'       => trans('app.msgbox.screenshot.title'),
            'msg'         => trans('app.msgbox.screenshot.msg'),
            'redirect'    => trans('app.msgbox.screenshot.redirect'),
            'redirect_to' => url('games', $gameid),
        ];

        return view('msgbox', $msg);
    }

    public function cdc_add()
    {
        $msg = [
            'title'       => trans('app.msgbox.cdc.title'),
            'msg'         => trans('app.msgbox.cdc.msg'),
            'redirect'    => trans('app.msgbox.cdc.redirect'),
            'redirect_to' => url('/'),
        ];

        return view('msgbox', $msg);
    }
}
