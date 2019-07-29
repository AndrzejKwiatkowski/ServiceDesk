<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('users')->insert([[
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('123qweasd'),
                'role_id' => '1',

            ],
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'password' => bcrypt('123qweasd'),
                'role_id' => '2',

            ],
            [
                'name' => 'User2',
                'email' => 'user2@test.com',
                'password' => bcrypt('123qweasd'),
                'role_id' => '2',

            ]]);
        }
    }
}
