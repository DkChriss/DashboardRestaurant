<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionRequest;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update-role-permission', ['only' => ['update']]);
        $this->middleware('permission:show-role-permission', ['only' => ['show']]);
    }

    public function update(Role $rolePermission, PermissionRequest $request)
    {
        $rolePermission->syncPermissions($request->permission_id);
        return $this->successResponse('Se ha realizado la asignación');
    }

    public function show(Role $rolePermission)
    {
        $roleWithPermissions = $rolePermission->permissions;
        return $this->successResponse($roleWithPermissions);
    }
}
