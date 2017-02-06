<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
    public function createRole()
    {
        $roles = UserRole::all();

        return view('users.entrust.addrole', [
            'roles' => $roles,
        ]);
    }

    public function storeRole(Request $request)
    {
        $r = new UserRole();
        $r->name = $request->get('name');
        $r->display_name = $request->get('dname');
        $r->description = $request->get('desc');
        $r->save();

        return redirect()->action('UserPermissionController@createRole');
    }

    public function createPermission()
    {
        $perms = UserPermission::all();

        return view('users.entrust.addperm', [
            'perms' => $perms,
        ]);
    }

    public function storePermission(Request $request)
    {
        $p = new UserPermission();
        $p->name = $request->get('name');
        $p->display_name = $request->get('dname');
        $p->description = $request->get('desc');
        $p->save();

        return redirect()->action('UserPermissionController@createPermission');
    }

    public function showRole($id)
    {
        $p = \DB::table('user_permission_role as pr')
            ->leftJoin('user_permissions as p', 'pr.permission_id', '=', 'p.id')
            ->where('pr.role_id', '=', $id)
            ->get();

        $ptoadd = UserPermission::all();

        return view('users.entrust.showrole', [
            'perms'      => $p,
            'roleid'     => $id,
            'permstoadd' => $ptoadd,
        ]);
    }

    public function addPermToRole(Request $request, $roleid)
    {
        $role = UserRole::all()->where('id', '=', $roleid)->first();
        $perm = UserPermission::all()->where('id', '=', $request->get('perm'))->first();

        $role->attachPermission($perm);

        return redirect()->action('UserPermissionController@showRole', $roleid);
    }

    public function removePermFromRole($roleid, $permid)
    {
        $role = UserRole::all()->where('id', '=', $roleid)->first();
        $perm = UserPermission::all()->where('id', '=', $permid)->first();

        $role->detachPermission($perm);

        return redirect()->action('UserPermissionController@showRole', $roleid);
    }

    public function showPermission($id)
    {
    }
}
