<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cliente
        Permission::create(['name' => 'create-cliente', 'type' => 'Cliente']);
        Permission::create(['name' => 'edit-cliente',   'type' => 'Cliente']);
        Permission::create(['name' => 'delete-cliente', 'type' => 'Cliente']);
        Permission::create(['name' => 'view-cliente',   'type' => 'Cliente']);

        // combos
        Permission::create(['name' => 'create-combos', 'type' => 'Combos']);
        Permission::create(['name' => 'edit-combos',   'type' => 'Combos']);
        Permission::create(['name' => 'delete-combos', 'type' => 'Combos']);
        Permission::create(['name' => 'view-combos',   'type' => 'Combos']);


        // usuarios
        Permission::create(['name' => 'create-user',       'type' => 'User']);
        Permission::create(['name' => 'edit-user',         'type' => 'User']);
        Permission::create(['name' => 'delete-user',       'type' => 'User']);
        Permission::create(['name' => 'view-user',         'type' => 'User']);
        Permission::create(['name' => 'assign-rol',        'type' => 'User']);
        Permission::create(['name' => 'assign-permission', 'type' => 'User']);
        // roles
        Permission::create(['name' => 'create-role', 'type' => 'Role']);
        Permission::create(['name' => 'edit-role',   'type' => 'Role']);
        Permission::create(['name' => 'delete-role', 'type' => 'Role']);
        Permission::create(['name' => 'view-role',   'type' => 'Role']);
        Permission::create(['name' => 'update-role-permission', 'type' => 'Role']);
        Permission::create(['name' => 'show-role-permission',   'type' => 'Role']);

        // dishe
        Permission::create(['name' => 'create-dishe', 'type' => 'Dishe']);
        Permission::create(['name' => 'edit-dishe',   'type' => 'Dishe']);
        Permission::create(['name' => 'delete-dishe', 'type' => 'Dishe']);
        Permission::create(['name' => 'view-dishe',   'type' => 'Dishe']);

        // Drink
        Permission::create(['name' => 'create-drink', 'type' => 'Drink']);
        Permission::create(['name' => 'edit-drink',   'type' => 'Drink']);
        Permission::create(['name' => 'delete-drink', 'type' => 'Drink']);
        Permission::create(['name' => 'view-drink',   'type' => 'Drink']);

        // order-combo
        Permission::create(['name' => 'create-order-combo', 'type' => 'Order Combo']);
        Permission::create(['name' => 'edit-order-combo',   'type' => 'Order Combo']);
        Permission::create(['name' => 'delete-order-combo', 'type' => 'Order Combo']);
        Permission::create(['name' => 'view-order-combo',   'type' => 'Order Combo']);

        // order-dishe
        Permission::create(['name' => 'create-order-dishe', 'type' => 'Order Dishe']);
        Permission::create(['name' => 'edit-order-dishe',   'type' => 'Order Dishe']);
        Permission::create(['name' => 'delete-order-dishe', 'type' => 'Order Dishe']);
        Permission::create(['name' => 'view-order-dishe',   'type' => 'Order Dishe']);

        // order-drink
        Permission::create(['name' => 'create-order-drink', 'type' => 'Order Drink']);
        Permission::create(['name' => 'edit-order-drink',   'type' => 'Order Drink']);
        Permission::create(['name' => 'delete-order-drink', 'type' => 'Order Drink']);
        Permission::create(['name' => 'view-order-drink',   'type' => 'Order Drink']);

        // shopping
        Permission::create(['name' => 'create-shopping', 'type' => 'Shopping']);
        Permission::create(['name' => 'edit-shopping',   'type' => 'Shopping']);
        Permission::create(['name' => 'delete-shopping', 'type' => 'Shopping']);
        Permission::create(['name' => 'view-shopping',   'type' => 'Shopping']);

    }
}
