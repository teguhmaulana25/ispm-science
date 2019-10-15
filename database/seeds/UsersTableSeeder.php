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
        $user_data = [
            [
              'name' => 'Teguh Maulana',
              'username' => 'dr_teguh',
              'email' => 'teguh@example.com',
              'password' => bcrypt('admin'),
              'status' => 1,
              'created_by' => 'teguh@example.com',
              'updated_by' => 'teguh@example.com',
              'created_at' => date("Y-m-d H:i:s"),
              'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Mr Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
                'status' => 1,
                'created_by' => 'teguh@example.com',
                'updated_by' => 'teguh@example.com',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
              ]
          ];
          DB::table('users')->insert($user_data);
    }
}
