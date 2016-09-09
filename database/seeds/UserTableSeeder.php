<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'              => 'admin',
	        'email'             => env('ADMIN_MAIL', 'admin@admin.com'),
	        'password'          => bcrypt( env('ADMIN_PASS', 'admin') ),
	        'remember_token'    => str_random(10),
	        'created_at'        => Carbon::now()->toDateTimeString(),
	        'updated_at'        => Carbon::now()->toDateTimeString()
        ]);

	    factory(App\Models\User::class, 10)->create();
    }
}
