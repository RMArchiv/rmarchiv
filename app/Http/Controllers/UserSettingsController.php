<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function index()
    {
        return view('auth.settings');
    }

    public function store_rowsPerPage(Request $req)
    {
        $this->validate($req, [
            'row_dev' => 'required',
            'row_games'   => 'required',
        ]);

        $set = UserSetting::whereUserId(\Auth::id())->first();
        $set->rows_per_page_games = $req->get('row_games');
        $set->rows_per_page_developer = $req->get('row_dev');
        $set->save();

        return redirect()->action('UserSettingsController@index');
    }

    public function change_username(Request $request)
    {
        $this->validate($request, [
            'usernameold' => 'required',
            'usernamenew'   => 'required',
        ]);

        if (\Auth::user()->name == $request->get('usernameold')) {
            $check = User::whereName($request->get('usernamenew'))->get();

            if ($check->count() == 0) {
                $user = \Auth::user();
                $user->name = $request->get('usernamenew');
                $user->save();
            }
        }

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

    public function change_setting($setting, $value)
    {
        $set = UserSetting::whereUserId(\Auth::id())->first();

        $set->update([$setting => $value]);

        return redirect()->action('UserSettingsController@index');
    }

    public function change_language(Request $request){
        $l = UserSetting::whereUserId(\Auth::id())->first();
        $l->language = $request->get('language');
        $l->save();

        return redirect()->back();
    }

    public function change_download_template(Request $request){
        $l = UserSetting::whereUserId(\Auth::id())->first();
        $l->download_template = $request->get('download_template');
        $l->save();

        return redirect()->back();
    }
}
