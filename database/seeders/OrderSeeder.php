<?php

namespace Database\Seeders;

use App\Models\DeveloperPrestation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public static int $NB_ORDERS_IN_DB = 24;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nbPrestationsInDB = DeveloperPrestation::select('id')->count();
        $isPayed = [0, 1];

        $clients = User::where('role_id', 1)->get();
        $clientsId = [];
        foreach ($clients as $client) {
            $clientsId[] = $client['id'];
        }

        $ordersData = [];
        for ($i = 1; $i <= self::$NB_ORDERS_IN_DB; $i++) {
            $ordersData[] = [
                'client_id'         => $clientsId[array_rand($clientsId, 1)],
                'dev_prestation_id' => rand(1, $nbPrestationsInDB),
                'is_payed'          => $isPayed[array_rand($isPayed, 1)],
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        DB::table('orders')->insert(
            $ordersData
        );
    }
}
