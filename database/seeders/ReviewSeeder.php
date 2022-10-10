<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public static int $NB_REVIEWS_IN_DB = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = User::where('role_id', 1)->get();
        $clientsId = [];
        foreach ($clients as $client) {
            $clientsId[] = $client['id'];
        }

        $orders = Order::select('id')->get();
        $ordersId = [];
        foreach ($orders as $order) {
            $ordersId[] = $order['id'];
        }

        $reviewsData = [];
        if (User::where('role_id', 1)) {
            for ($i = 1; $i <= self::$NB_REVIEWS_IN_DB; $i++) {
                $reviewsData[] = [
                    'client_id'  => $clientsId[array_rand($clientsId, 1)],
                    'order_id'   => $ordersId[array_rand($ordersId, 1)],
                    'comment'    => fake()->realTextBetween(5, 35),
                    'rating'     => rand(1, 5),
                    'created_at' => '2022-09-25 10:50:12',
                    'updated_at' => '2022-09-26 15:25:52',
                ];
            }
        }

        DB::table('reviews')->insert(
            $reviewsData
        );
    }
}
