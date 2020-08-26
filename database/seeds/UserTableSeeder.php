<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $administrador = User::create([
            'name' => 'administrador',
            'lastname' => 'administrador',
            'email' => 'administrador@hotmail.com',
            'username' => 'pukis.admin',
            'password' => bcrypt('password'),
            'address' => 'Calle 23 de Marzo entre Adrian Patiño',
            'phone' => '4285074'
        ]);

        $cajero = User::create([
            'name' => 'Cajero',
            'lastname' => 'Cajero',
            'email' => 'cajero@hotmail.com',
            'username' => 'pukis.cajero',
            'password' => bcrypt('password'),
            'address' => 'Calle 23 de Marzo',
            'phone' => '71754190'
        ]);

        $secretaria = User::create([
            'name' => 'secretaria',
            'lastname' => 'secretaria',
            'email' => 'secretaria@hotmail.com',
            'username' => 'pukis.secretaria',
            'password' => bcrypt('password'),
            'address' => 'Calle 23 de Marzo entre Adrian Patiño',
            'phone' => '4241970'
        ]);

        

        factory(User::class, 50)->create();
    }
}
