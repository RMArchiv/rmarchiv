<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class MsgBoxController extends Controller
{
    public function submit_logo() {
        $msg = [
            'title' => trans('app.submit.logo.success.title'),
            'msg' => trans('app.submit.logo.success.msg'),
            'redirect' => trans('app.submit.logo.success.redirect'),
            'redirect_to' => url('logo/vote'),
        ];

        return view('msgbox', $msg);
    }

    public function comment_add($type, $id) {
        $msg = [
            'title' => trans('app.news.comments.success.title'),
            'msg' => trans('app.news.comments.success.msg'),
            'redirect' => trans('app.news.comments.success.redirect'),
        ];

        if ($type == 'news') {
            $msg['redirect_to'] = url('news', $id);
        }elseif ($type == 'game') {
            $msg['redirect_to'] = url('games', $id);
        }elseif ($type == 'resource') {
            $msg['redirect_to'] = route('resources.show', DatabaseHelper::getResourcePathArray($id));
        }

        return view('msgbox', $msg);
    }

    public function game_add($id) {
        $msg = [
            'title' => trans('app.games.add.success.title'),
            'msg' => trans('app.games.add.success.msg'),
            'redirect' => trans('app.games.add.success.redirect'),
            'redirect_to' => url('games', $id),
        ];

        return view('msgbox', $msg);
    }

    public function screenshot_add($gameid) {
        $msg = [
            'title' => 'screenshot erfolgreich hinzugefügt',
            'msg' => 'der screenshot wurde erfolgreich hinzugefügt',
            'redirect' => 'zurück zum spiel...',
            'redirect_to' => url('games', $gameid),
        ];

        return view('msgbox', $msg);
    }

    public function cdc_add($gameid) {
        $msg = [
            'title' => 'coup de coeur erfolgreich hinzugefügt',
            'msg' => 'coup de coeur wurde erfolgreich hinzugefügt',
            'redirect' => 'zurück zum index...',
            'redirect_to' => url('/'),
        ];

        return view('msgbox', $msg);
    }
}
