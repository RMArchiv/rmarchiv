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

        return view('users.index', ['users' => $user]);
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
