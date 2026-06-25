<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\User;
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
        $role = UserRole::all()->where('id', $id)->first();

        return view('users.entrust.showrole', [
            'perms'      => $p,
            'roleid'     => $id,
            'permstoadd' => $ptoadd,
            'role' => $role
        ]);
    }

    public function addPermToRole(Request $request, $roleid)
    {
        $role = UserRole::all()->where('id', '=', $roleid)->first();
        $perm = UserPermission::all()->where('id', '=', $request->get('perm'))->first();

        $role->givePermission($perm);

        return redirect()->action('UserPermissionController@showRole', $roleid);
    }

    public function removePermFromRole($roleid, $permid)
    {
        $role = UserRole::all()->where('id', '=', $roleid)->first();
        $perm = UserPermission::all()->where('id', '=', $permid)->first();

        $role->removePermission($perm);

        return redirect()->action('UserPermissionController@showRole', $roleid);
    }

    public function showPermission($id)
    {
    }

    public function indexUserAssignments(Request $request)
    {
        $search = trim((string) $request->get('q', ''));
        $users = User::with(['roles', 'permissions'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('name')
            ->paginate(25)
            ->appends(['q' => $search]);

        return view('users.entrust.userindex', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function editUserAssignments(User $user)
    {
        $user->load(['roles', 'permissions']);

        return view('users.entrust.userassignments', [
            'user' => $user,
            'roles' => UserRole::orderBy('name')->get(),
            'permissions' => UserPermission::orderBy('name')->get(),
            'assignedRoleIds' => $user->roles->pluck('id')->all(),
            'assignedPermissionIds' => $user->permissions->pluck('id')->all(),
        ]);
    }

    public function updateUserAssignments(Request $request, User $user)
    {
        $data = $request->validate([
            'roles' => ['array'],
            'roles.*' => ['integer', 'exists:user_roles,id'],
            'permissions' => ['array'],
            'permissions.*' => ['integer', 'exists:user_permissions,id'],
        ]);

        $user->syncRoles($data['roles'] ?? []);
        $user->syncPermissions($data['permissions'] ?? []);

        return redirect()
            ->route('user.perm.user.edit', $user)
            ->with('status', 'Benutzerberechtigungen wurden gespeichert.');
    }
}
