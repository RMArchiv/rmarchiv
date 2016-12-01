<?php

namespace App\Http\Controllers;

use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function createRole(){
        $roles = UserRole::all();

        return view('users.entrust.addrole', [
            'roles' => $roles
        ]);
    }

    public function storeRole(Request $request){
        $r = new UserRole();
        $r->name = $request->get('name');
        $r->display_name = $request->get('dname');
        $r->description = $request->get('desc');
        $r->save();

        return redirect()->action('UserPermissionController@createRole');
    }

    public function createPermission(){
        $perms = UserPermission::all();

        return view('users.entrust.addperm', [
            'perms' => $perms
        ]);
    }

    public function storePermission(Request $request){
        $p = new UserPermission();
        $p->name = $request->get('name');
        $p->display_name = $request->get('dname');
        $p->description = $request->get('desc');
        $p->save();

        return redirect()->action('UserPermissionController@createPermission');
    }

    public function showRole($id){

    }

    public function  showPermission($id){

    }
}
