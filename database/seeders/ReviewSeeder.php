<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public static int $NB_REVIEWS_IN_DB = 80;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // client_id: de 16 à 25
        // order_id: de 1 à 9
        // developer_id: de 1 à 8

        DB::table('reviews')->insert([
            [
                'client_id'    => 16,
                'order_id'     => 1,
                'developer_id' => 8,
                'comment'      => fake()->realTextBetween(10, 25),
                'rating'       => 0,
                'created_at'   => '2022-09-25 10:50:12',
                'updated_at'   => '2022-09-26 15:25:52',
            ],
            [
                'client_id'    => 20,
                'order_id'     => 2,
                'developer_id' => 2,
                'comment'      => null,
                'rating'       => 4,
                'created_at'   => '2022-09-25 10:50:12',
                'updated_at'   => '2022-09-26 15:25:52',
            ],
            [
                'client_id'    => 17,
                'order_id'     => 3,
                'developer_id' => 6,
                'comment'      => fake()->realTextBetween(10, 25),
                'rating'       => 2,
                'created_at'   => '2022-09-25 10:50:12',
                'updated_at'   => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
