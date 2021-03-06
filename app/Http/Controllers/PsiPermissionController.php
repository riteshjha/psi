<?php

namespace App\Http\Controllers;

use App\Models\PermissionModel;
use App\Models\Role;
use App\Models\RolesToPermission_rel;
use App\Models\User;
use App\Models\UserToPermission_rel;
use Auth;
use Illuminate\Http\Request;
use Session;

class PsiPermissionController extends Controller
{

    public function updateRole(Request $request, $roleid)
    {
        $allPermission = RolesToPermission_rel::where('role_id', $roleid)->get();
        $permissionsOfRole = [];
        foreach ($allPermission as $all) {
            array_push($permissionsOfRole, $all->permission_id);
        }
        $role = Role::find($roleid);
        $permission_relation = [];
        $permissions = PermissionModel::orderBy('prefix', 'perm_name')->get();
//        dd($permissions);
        foreach ($permissions as $row) {
            $permission_relation[$row->prefix][] = $row;
        }
//        dd($permissionsOfRole);
//        dd($permission_relation);
        //roles for roleid
        $new = PermissionModel::all();
        $a = [];
        foreach ($new as $n) {
            if ($n->prefix[0] == '/')
                $n->prefix = substr($n->prefix, 1);
            $b = explode('/', $n->prefix);
            if (count($b) == 1)
                $a[$b[0]][] = $n;
            elseif (count($b) == 2)
                $a[$b[0]][$b[1]][] = $n;

        }
//        dd($a);
        return view('pages/roleUpdateForm', compact('permission_relation', 'a'))->withRole($role)->withPermissionsOfRole($permissionsOfRole);
    }

    public function storeUpdate(Request $request, $roleid)
    {
        $old = RolesToPermission_rel::where('role_id', $roleid)->get();
        foreach ($old as $o) {
            $o->delete();
        }
        $permissions = $request->customized;
        if (count($permissions) > 0) {
//        dd($permissions);
            foreach ($permissions as $permission) {
                $userToPermission = new RolesToPermission_rel();
                $userToPermission->role_id = $roleid;
                $userToPermission->permission_id = $permission;
                $userToPermission->save();
            }
        }

        Session::flash('success', trans('employee.Permissionsuccessfullyassigned!'));
        return redirect()->route('roles.index', $roleid);

    }

    public function updateUser(Request $request)
    {
        $new = PermissionModel::all();
        $a = [];
        foreach ($new as $n) {
            if ($n->prefix[0] == '/')
                $n->prefix = substr($n->prefix, 1);
            $b = explode('/', $n->prefix);
            if (count($b) == 1)
                $a[$b[0]][] = $n;
            elseif (count($b) == 2)
                $a[$b[0]][$b[1]][] = $n;

        }

        $user = User::all();
        return view('pages/userUpdateForm', compact('a', 'user'));
    }

    public function getUserPermission(Request $request)
    {
        if ($request->ajax()) {
            $user_id = $request->get('user_id');
            $permissions = UserToPermission_rel::where('user_id', $user_id)->get();
            $allPermissions = [];
            if ($permissions->count() > 0) {
                foreach ($permissions as $permission) {
                    array_push($allPermissions, $permission->permission_id);
                }
            } else {
                $user = User::find($user_id);
                $role_id = $user->role_id;

                $rolePermissions = RolesToPermission_rel::where('role_id', $role_id)->get();

                if ($rolePermissions->count() > 0) {
                    foreach ($rolePermissions as $role) {
                        array_push($allPermissions, $role->permission_id);
                    }
                } else
                    $allPermissions = 0;

            }
        } else {
            $allPermissions = 0;
        }

        echo json_encode($allPermissions);
    }

    public function storePermissionToUser(Request $request)
    {
        $user_id = $request->userUpdate;
        $old = UserToPermission_rel::where('user_id', $user_id)->get();
        if (count($old) > 0) {
            foreach ($old as $o) {
                $o->delete();
            }
        }
        $permissions = $request->customized;
        if (count($permissions) > 0) {

            foreach ($permissions as $permission) {
                $userToPermission = new UserToPermission_rel();
                $userToPermission->user_id = $user_id;
                $userToPermission->permission_id = $permission;
                $userToPermission->save();
            }
        }

        Session::flash('success', trans('employee.Permissionsuccessfullyassigned!'));
        return redirect()->route('update.user');
    }
}
