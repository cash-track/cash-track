<?php

use Illuminate\Database\Seeder;

class TransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Trans::class, 200)->create();
    }
}
