<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\PermissionRequest;

class UserPermissionController extends Controller
{
    public function __construct()
    {

    }

    public function update(User $userPermission, PermissionRequest $request)
    {
        $userPermission->syncPermissions($request->permission_id);
        return $this->successResponse('Se ha realizado la asignación');
    }

    public function show(User $userPermission)
    {
        $userWithPermissions = $userPermission->permissions;
        return $this->successResponse($userWithPermissions);
    }
}
