<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function getRoles() {
        $role = Role::all();

        return response()->json([
            'roles' => $role,
        ]);
    }

    public function addRole(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create($request->all());

        return response()->json([
            'message' => 'Role added successfully',
            'role' => $role
        ]);
    }

    public function editRole(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::find($id);

        if(!$role) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }

        $role->update($request->all());

        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role
        ]);
    }

    public function deleteRole($id) {
        $role = Role::find($id);

        if(!$role) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }

        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }
}
