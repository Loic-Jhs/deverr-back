<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeveloperSeeder extends Seeder
{
    public static int $NB_DEVELOPERS_IN_DB = 8;
    public static int $NB_USERS_IN_DB = 20;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developers')->insert([
            [
                'user_id' => 14,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 15,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 16,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 17,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 18,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 19,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 20,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 21,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 22,
                'description' => fake()->realTextBetween(20, 100),
                'avatar' => 'https://picsum.photos/200/300',
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
