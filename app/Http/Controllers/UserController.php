<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::orderBy('name')->paginate(15);

        //name
        //created_at
        //levelname
        //obyx in Prozent
        $user = \DB::table('users as u')
            ->leftJoin('user_role_user as uru', 'u.id', '=', 'uru.user_id')
            ->leftJoin('user_roles as ur', 'ur.id', '=', 'uru.role_id')
            ->select([
                'u.id as userid',
                'u.name as username',
                'u.created_at as usercreated_at',
                'ur.display_name as rolename',
                'ur.description as roledesc'
            ])
            ->selectRaw('(SELECT SUM(obyx.value) FROM user_obyx LEFT JOIN obyx ON obyx.id = user_obyx.obyx_id WHERE user_obyx.user_id = u.id) as obyx')
            ->orderBy('u.name')
            ->get();

        $obyxmax = \DB::table('user_obyx as uo')
            ->leftJoin('obyx as o', 'o.id', '=', 'uo.obyx_id')
            ->selectRaw('SUM(o.value) as value')
            ->groupBy('uo.user_id')
            ->orderByRaw('SUM(o.value) DESC')
            ->first();

        return view('users.index', [
            'users' => $user,
            'obyxmax' => $obyxmax,
        ]);
    }

    public function get(){

    }

    public function admin($userid){

        if(\Auth::check()){
            if(\Auth::user()->settings->is_admin == 1){
                $user = User::whereId($userid)->first();

                $perms = UserRole::all();

                return view('users.admin', [
                    'user' => $user,
                    'perms' => $perms,
                ]);
            }
        }

    }

    public function admin_store(Request $request, $userid){

        $role = UserRole::all()->where('id', '=', $request->get('perm'))->first();
        $user = User::find($userid);

        $user->detachRoles($user->roles);
        $user->attachRole($role);

        return redirect()->action('UserController@admin', [$userid]);
    }
}
