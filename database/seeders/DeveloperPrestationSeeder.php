<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\PrestationType;
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
        // developer_id: de 1 à 8.
        // prestation_type_id: de 1 à 9.

        DB::table('developer_prestations')->insert([
            [
                'developer_id'  => 1,
                'prestation_type_id' => 3,
                'price'         => fake()->randomFloat(2, 100, 900),
                'description'   => fake()->realTextBetween(35, 65),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 1,
                'prestation_type_id' => 1,
                'price'         => fake()->randomFloat(2, 100, 900),
                'description'   => fake()->realTextBetween(35, 65),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 2,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 5,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 2,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 7,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 3,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 2,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'  => 3,
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => 9,
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ]
        ]);
    }
}
