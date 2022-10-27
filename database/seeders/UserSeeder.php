<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static int $NB_ADMINS_IN_DB = 2;

    public static int $NB_USERS_IN_DB = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [];
        for ($i = 1; $i <= self::$NB_ADMINS_IN_DB; $i++) {
            $admins[] = [
                'email' => fake()->email(),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'role' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $users[] = [
                'email' => fake()->email(),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'role' => "0",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $users = array_merge($users, $admins);

        DB::table('users')->insert($users);
    }
}
