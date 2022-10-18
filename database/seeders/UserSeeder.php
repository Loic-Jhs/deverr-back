<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static int $NB_ADMINS_IN_DB = 2;
    public static int $NB_CLIENTS_ACTIVE_IN_DB = 5;
    public static int $NB_CLIENTS_NOT_ACTIVE_IN_DB = 5;
    public static int $NB_DEVS_ACTIVE_IN_DB = 8;
    public static int $NB_DEVS_NOT_ACTIVE_IN_DB = 7;

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
                'email_verified_at' => '2022-09-24 10:50:12',
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => 3,
                'is_account_active' => 1,
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        $developersActive = [];
        for ($i = 1; $i <= self::$NB_DEVS_ACTIVE_IN_DB; $i++) {
            $developersActive[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => '2022-09-24 10:50:12',
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => 2,
                'is_account_active' => 1,
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        $developersNotActive = [];
        for ($i = 1; $i <= self::$NB_DEVS_NOT_ACTIVE_IN_DB; $i++) {
            $developersNotActive[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => null,
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => 2,
                'is_account_active' => 0,
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        $clientsActive = [];
        for ($i = 1; $i <= self::$NB_CLIENTS_ACTIVE_IN_DB; $i++) {
            $clientsActive[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => '2022-09-24 10:50:12',
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => 1,
                'is_account_active' => 1,
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        $clientsNotActive = [];
        for ($i = 1; $i <= self::$NB_CLIENTS_NOT_ACTIVE_IN_DB; $i++) {
            $clientsNotActive[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => null,
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => 1,
                'is_account_active' => 0,
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        $users = array_merge($developersActive, $developersNotActive, $clientsActive, $clientsNotActive, $admins);

        DB::table('users')->insert($users);
    }
}
