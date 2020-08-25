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
        $user = User::find(1);
        $user1 = User::find(2);
        $user2 = User::find(3);

        $admin = Role::create(['name' => 'ADMIN']);
        $admin->givePermissionTo(Permission::all());

        $admin_1 = Role::create(['name' => 'CAJERO']);
        $admin_1->givePermissionTo(Permission::whereIn(
            'type',
            [
                'Shopping',
                'Order Combo',
                'Order Dish',
                'Order Drink',
            ]
        )->get());

        $admin_2 = Role::create(['name' => 'SECRETARIA']);
        $admin_2->givePermissionTo(Permission::whereIn(
            'type',
            [
                'Shopping',
                'Order Combo',
                'Order Dish',
                'Order Drink',
            ]
        )->get());

        $user->assignRole($admin);
        $user1->assignRole($admin_1);
        $user2->assignRole($admin_2);
    }
}
