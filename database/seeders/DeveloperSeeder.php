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
                'description' => fake()->text(45),
                'avatar' => asset('/images/avatar/14/random1.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 15,
                'description' => fake()->text(40),
                'avatar' => asset('/images/avatar/15/random2.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 16,
                'description' => fake()->text(60),
                'avatar' => asset('/images/avatar/16/random3.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 17,
                'description' => fake()->text(40),
                'avatar' => asset('/images/avatar/17/random4.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 18,
                'description' => fake()->text(70),
                'avatar' => asset('/images/avatar/18/random5.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 19,
                'description' => fake()->text(125),
                'avatar' => asset('/images/avatar/19/random6.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 20,
                'description' => fake()->text(212),
                'avatar' => asset('/images/avatar/20/random7.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 21,
                'description' => fake()->text(250),
                'avatar' => asset('/images/avatar/21/random8.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 22,
                'description' => fake()->text(128),
                'avatar' => asset('/images/avatar/22/random9.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
