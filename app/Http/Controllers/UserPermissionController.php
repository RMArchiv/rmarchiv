<?php

namespace App\Http\Controllers;

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
}
