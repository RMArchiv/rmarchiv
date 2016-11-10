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
}
