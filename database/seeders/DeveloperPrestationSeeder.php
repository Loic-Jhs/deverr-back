<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Prestation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperPrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // client_id: 16 à 25
        // developer_id: de 1 à 8.
        // prestation_id: de 1 à 9.

        DB::table('developer_prestations')->insert([
            [
                'developer_id'  => 1,
                'client_id'     => 16,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 9,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 1,
                'client_id'     => 17,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 1,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 2,
                'client_id'     => 18,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 3,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 2,
                'client_id'     => 19,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 5,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 2,
                'client_id'     => 20,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 7,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 3,
                'client_id'     => 21,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 2,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 3,
                'client_id'     => 22,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 9,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 4,
                'client_id'     => 23,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 4,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 8,
                'client_id'     => 24,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 1,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 8,
                'client_id'     => 25,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 7,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
