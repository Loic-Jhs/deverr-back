<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2019-12-02 20:01:00',
                'firstname' => Str::random(5),
                'lastname' => Str::random(5),
                'role_id' => 3,
                'is_account_active' => '1',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'user',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2019-12-02 20:01:00',
                'firstname' => Str::random(5),
                'lastname' => Str::random(5),
                'role_id' => 1,
                'is_account_active' => '1',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'developer',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => '2019-12-02 20:01:00',
                'firstname' => Str::random(5),
                'lastname' => Str::random(5),
                'role_id' => 2,
                'is_account_active' => '1',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
