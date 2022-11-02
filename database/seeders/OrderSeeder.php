<?php

namespace Database\Seeders;

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
                'instructions' => fake()->text(30),
                'is_payed' => 0,
                'is_accepted_by_developer' => null,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 6,
                'developer_id' => 3,
                'developer_prestation_id' => 2,
                'instructions' => fake()->text(20),
                'is_payed' => 0,
                'is_accepted_by_developer' => null,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 7,
                'developer_id' => 1,
                'developer_prestation_id' => 3,
                'instructions' => fake()->text(13),
                'is_payed' => 0,
                'is_accepted_by_developer' => null,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 8,
                'developer_id' => 2,
                'developer_prestation_id' => 4,
                'instructions' => fake()->text(10),
                'is_payed' => 0,
                'is_accepted_by_developer' => null,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 9,
                'developer_id' => 4,
                'developer_prestation_id' => 5,
                'instructions' => fake()->text(15),
                'is_payed' => 0,
                'is_accepted_by_developer' => null,
                'stripe_session_id' => null,
                'reference' => null,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
