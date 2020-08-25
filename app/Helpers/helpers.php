<?php
if (!function_exists('get_permissions')) {
    function get_permissions()
    {
        $permissions = Spatie\Permission\Models\Permission::all();
        return $permissions;
    }
}

if (!function_exists('get_roles')) {
    function get_roles()
    {
        $roles = Spatie\Permission\Models\Role::all();
        return $roles;
    }
}

if (!function_exists('get_permissionsType')) {
    function get_permissionsType()
    {
        $permissionsType =  \Illuminate\Support\Facades\DB::table('permissions')
            ->select('type')
            ->groupBy('type')
            ->get();

        return $permissionsType;
    }
}
