<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public static int $NB_USERS_IN_DB = 35;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleId = [1, 2, 3];
        $accountActive = [0, 1];

        $emailVerifiedAt = [
            null,
            '2022-10-01 09:45:02',
            '2022-09-02 19:05:22',
        ];

        $usersData = [];
        for ($i = 1; $i <= self::$NB_USERS_IN_DB; $i++) {
            $usersData[] = [
                'email'             => fake()->email(),
                'password'          => Hash::make('password'),
                'email_verified_at' => $emailVerifiedAt[array_rand($emailVerifiedAt, 1)],
                'firstname'         => fake()->firstName(),
                'lastname'          => fake()->lastName(),
                'role_id'           => $roleId[array_rand($roleId, 1)],
                'is_account_active' => $accountActive[array_rand($accountActive, 1)],
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        DB::table('users')->insert(
            $usersData
        );
    }
}
