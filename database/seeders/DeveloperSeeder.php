<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeveloperSeeder extends Seeder
{
    public static int $NB_DEVELOPERS_IN_DB = 8;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = [];
        for ($i = 1; $i <= self::$NB_DEVELOPERS_IN_DB; $i++) {
            $developers[] = [
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => Hash::make('password'),
                'description' => fake()->realTextBetween(10, 25),
                'avatar' => fake()->imageUrl(200, 200),
                'years_of_experience' => fake()->numberBetween(1, 10),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('developers')->insert($developers);
    }
}
