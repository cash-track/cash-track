<?php

use Illuminate\Database\Seeder;

class BalanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Balance::class, 10)->create();
    }
}
