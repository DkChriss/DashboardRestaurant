<?php

use App\Shopping;
use Illuminate\Database\Seeder;

class ShoppingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Shopping::class, 50)->create();
    }
}
