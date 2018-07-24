<?php
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			[
			     'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => '2',
        	   'password' => bcrypt('admin123'),
             'token' => str_random(50),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
			],
			[
			     'name' => 'indrabrada',
            'email' => 'indra@gmail.com',
            'role' => '1',
        	   'password' => bcrypt('123456'),
             'token' => str_random(50),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
			],
			[
			     'name' => 'luki',
            'email' => 'luki@gmail.com',
            'role' => '1',
        	   'password' => bcrypt('123456'),
             'token' => str_random(50),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
			],
            [
            'name' => 'joe',
            'email' => 'joe@gmail.com',
            'role' => '1',
            'password' => bcrypt('123456'),
            'token' => str_random(50),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ],
		]);
	}
}
