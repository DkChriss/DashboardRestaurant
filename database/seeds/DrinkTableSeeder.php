<?php

use App\Drink;
use Illuminate\Database\Seeder;

class DrinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Drink::class, 10)->create();
    }
}
