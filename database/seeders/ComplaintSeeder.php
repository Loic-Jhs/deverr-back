<?php

namespace Database\Seeders;

use App\Models\Prestation;
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
        // dev_prestation_id: de 1 à 7

        DB::table('complaints')->insert([
            [
                'user_id'           => 25,
                'dev_prestation_id' => 7,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'user_id'           => 16,
                'dev_prestation_id' => 1,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'user_id'           => 19,
                'dev_prestation_id' => 5,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'user_id'           => 19,
                'dev_prestation_id' => 6,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'user_id'           => 22,
                'dev_prestation_id' => 3,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'user_id'           => 21,
                'dev_prestation_id' => 6,
                'complaint'         => fake()->realTextBetween(15, 100),
                'status'            => rand(1, 2),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
