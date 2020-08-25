<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarioEricka = User::where('username', 'ericka.ergueta')->first();
        $usuarioVanessa = User::where('username', 'vanessa.candia')->first();
        $usuarioSara = User::where('username', 'sara.luna')->first();
        $usuarioCinthya = User::where('username', 'cinthya.pereira')->first();
        $usuarioCarmen = User::where('username', 'carmen.ayala')->first();

        $admin = Role::create(['name' => 'ADMINISTRADOR']);
        $admin->givePermissionTo(Permission::all());

        $admin_1 = Role::create(['name' => 'CAJERO']);
        $admin_1->givePermissionTo(Permission::all());

        $admin_2 = Role::create(['name' => 'SECRETARIA']);
        $admin_2->givePermissionTo(Permission::all());
    }
}
