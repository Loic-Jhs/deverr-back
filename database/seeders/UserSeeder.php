<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static int $NB_ADMINS_IN_DB = 2;

    // admin role = 2, user role = 0, developer role = 1

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
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role'              => "2",
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role'              => "0",
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        $developers = [];
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role'              => "1",
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        $users = array_merge($admins, $users, $developers);

        DB::table('users')->insert($users);
    }
}
