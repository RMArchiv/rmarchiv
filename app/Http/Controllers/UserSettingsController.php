<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function index()
    {
        return view('auth.settings');
    }

    public function store_password(Request $request)
    {
        $this->validate($request, [
            'passwordold' => 'required',
            'password1'   => 'required',
            'password2'   => 'required',
        ]);

        if ($request->get('password1') == $request->get('password2')) {
            if (\Hash::check($request->get('passwordold'), \Auth::user()->password)) {
                $user = \Auth::user();
                $user->password = \Hash::make($request->get('password1'));
                $user->save();
            }
        }

        return view('auth.settings');
    }

    public function change_setting($setting, $value){
        $set = UserSetting::whereUserId(\Auth::id())->first();

        $set->update([$setting => $value]);

        return redirect()->action('UserSettingsController@index');
    }
}
