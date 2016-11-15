<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MsgBoxController extends Controller
{
    public function submit_logo(){
        $msg = [
            'title' => trans('app.submit.logo.success.title'),
            'msg' => trans('app.submit.logo.success.msg'),
            'redirect' => trans('app.submit.logo.success.redirect'),
            'redirect_to' => url('logo/vote'),
        ];

        return view('msgbox', $msg);
    }

    public function comment_add($type, $id){
        $msg = [
            'title' => trans('app.news.comments.success.title'),
            'msg' => trans('app.news.comments.success.msg'),
            'redirect' => trans('app.news.comments.success.redirect'),
        ];

        if($type == 'news'){
            $msg['redirect_to'] = url('news', $id);
        }elseif($type == 'game'){
            $msg['redirect_to'] = url('games', $id);
        }

        return view('msgbox', $msg);
    }

    public function game_add($id){
        $msg = [
            'title' => trans('app.games.add.success.title'),
            'msg' => trans('app.games.add.success.msg'),
            'redirect' => trans('app.games.add.success.redirect'),
            'redirect_to' => url('games', $id),
        ];

        return view('msgbox', $msg);
    }
}
