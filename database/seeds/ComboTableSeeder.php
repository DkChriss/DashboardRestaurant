<?php

use App\Combo;
use Illuminate\Database\Seeder;

class ComboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Combo::class, 10)->create();
    }
}
