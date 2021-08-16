<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManageUsers extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('manage.index', ['roles' => $roles]);
    }
    public function create()
    {
        return view('manage.create');
    }
    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect('manage');
    }
    public function show($id)
    {
        return view('manage.edit');
    }
    public function edit($id)
    {
        $func = function ($val) {
            return $val['id'];
        };
        $role = Role::find($id);
        $perms = $role->permissions->toArray();
        $permissions = Permission::all()->except(array_map($func, $perms));
        return view('manage.edit', ['role' => $role, 'permissions' => $permissions]);
    }
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $newPermissions = explode(',', $request->roles);
        $alreadyAssignedPermissions = [];
        $revokepermissions = [];
        foreach ($role->permissions as $permission) {
            if (in_array($permission->name, $newPermissions)) {
                array_push($alreadyAssignedPermissions, $permission->name);
            } else {
                array_push($revokepermissions, $permission->name);
            }
        }
        foreach ($newPermissions as $newPermission) {
            if (!in_array($newPermission, $alreadyAssignedPermissions)) {
                $role->givePermissionTo($newPermission);
            }
        }
        foreach ($revokepermissions as $revokePermission) {
            $role->revokePermissionTo($revokePermission);
        }
        return redirect('manage');
    }
    function assignRoles($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $roles_ex = [];
        foreach ($roles as $role) {
            if (!in_array($role->name, $user->getRoleNames()->toArray())) {
                array_push($roles_ex, $role->name);
            }
        }
        return view('manage.assignRole', ['user' => $user, 'roles' => $roles_ex]);
    }
    function assignRolesPost(Request $request, $id)
    {

        $role = Role::find($id);
        $user = User::find($id);
        $newRoles = explode(',', $request->roles);
        $alreadyAssignedRoles = [];
        $revokeRoles = [];
        foreach ($user->getRoleNames() as $role) {
            if (in_array($role, $newRoles)) {
                array_push($alreadyAssignedRoles, $role);
            } else {
                array_push($revokeRoles, $role);
            }
        }
        foreach ($newRoles as $newRole) {
            if (!in_array($newRole, $alreadyAssignedRoles)) {
                $user->assignRole($newRole);
            }
        }
        foreach ($revokeRoles as $revokeRole) {
            $user->removeRole($revokeRole);
        }
        return redirect('display_users');
    }
}
