<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user_id: de 1 à 20
        // developer_prestation_id: de 1 à 6

        DB::table('orders')->insert([
            [
                'user_id' => 5,
                'developer_id' => 1,
                'developer_prestation_id' => 6,
                'instructions' => fake()->realTextBetween(10, 25),
                'is_payed' => 0,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 6,
                'developer_id' => 3,
                'developer_prestation_id' => 2,
                'instructions' => fake()->realTextBetween(10, 25),
                'is_payed' => 0,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 7,
                'developer_id' => 1,
                'developer_prestation_id' => 3,
                'instructions' => fake()->realTextBetween(10, 25),
                'is_payed' => 0,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 8,
                'developer_id' => 2,
                'developer_prestation_id' => 4,
                'instructions' => fake()->realTextBetween(10, 25),
                'is_payed' => 0,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 9,
                'developer_id' => 4,
                'developer_prestation_id' => 5,
                'instructions' => fake()->realTextBetween(10, 25),
                'is_payed' => 0,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
