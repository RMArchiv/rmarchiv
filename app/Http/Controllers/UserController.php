<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserObyx;
use App\Models\UserRole;
use App\Models\UserOnline;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('name')->paginate(25);

        $obyxmax = \DB::table('user_obyx as uo')
            ->leftJoin('obyx as o', 'o.id', '=', 'uo.obyx_id')
            ->selectRaw('SUM(o.value) as value')
            ->groupBy('uo.user_id')
            ->orderByRaw('SUM(o.value) DESC')
            ->first();

        return view('users.index', [
            'users'   => $user,
            'obyxmax' => $obyxmax,
        ]);
    }

    public function show($userid)
    {
        $user = User::whereId($userid)->first();

        $data = UserObyx::with('obyx', 'user')->orderBy('created_at', 'desc')->where('user_id', '=', $userid)->take(10)->get();

        return view('users.show', [
            'user' => $user,
            'obyx' => $data,
        ]);
    }

    public function admin($userid)
    {
        if (\Auth::check()) {
            if (\Auth::user()->settings->is_admin == 1) {
                $user = User::whereId($userid)->first();

                $perms = UserRole::all();

                return view('users.admin', [
                    'user'  => $user,
                    'perms' => $perms,
                ]);
            }
        }
    }

    public function admin_store(Request $request, $userid)
    {
        $role = UserRole::all()->where('id', '=', $request->get('perm'))->first();
        $user = User::find($userid);

        $user->detachRoles($user->roles);
        $user->attachRole($role);

        return redirect()->action('UserController@admin', [$userid]);
    }

    public function activity_index()
    {
        $data = UserObyx::with('obyx', 'user')->orderBy('created_at', 'desc')->paginate(25);

        return view('users.activity.index', [
            'obyx' => $data,
        ]);
    }

    public function users_online()
    {
        $uo = UserOnline::orderBy('created_at', 'desc')->get();

        return view('users.online', [
            'uo' => $uo,
        ]);
    }
}
