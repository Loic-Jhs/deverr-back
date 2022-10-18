<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public static int $NB_ORDERS_IN_DB = 25;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::select('id')->get();
        $ordersId = [];
        foreach ($orders as $order) {
            $ordersId[] = $order['id'];
        }

        $ordersData = [];
        for ($i = 1; $i <= self::$NB_ORDERS_IN_DB; $i++) {
            $ordersData[] = [
                'order_id'   => $ordersId[array_rand($ordersId, 1)],
                'number'     => fake()->numberBetween(100000000, 999999999),
                'state'      => rand(1, 3),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ];
        }

        DB::table('transactions')->insert(
            $ordersData
        );
    }
}
