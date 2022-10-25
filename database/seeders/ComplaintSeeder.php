<?php

namespace Database\Seeders;

use App\Models\PrestationType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user_id: de 16 à 25
        // order_id: de 1 à 5

        DB::table('complaints')->insert([
            [
                'order_id' => 1,
                'is_user_complaining' => rand(0, 1),
                'complaint' => fake()->realTextBetween(15, 100),
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 2,
                'is_user_complaining' => rand(0, 1),
                'complaint' => fake()->realTextBetween(15, 100),
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 3,
                'is_user_complaining' => rand(0, 1),
                'complaint' => fake()->realTextBetween(15, 100),
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 4,
                'is_user_complaining' => rand(0, 1),
                'complaint' => fake()->realTextBetween(15, 100),
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 5,
                'is_user_complaining' => rand(0, 1),
                'complaint' => fake()->realTextBetween(15, 100),
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ]
        ]);
    }
}
