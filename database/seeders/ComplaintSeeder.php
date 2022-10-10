<?php

namespace Database\Seeders;

use App\Models\Prestation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    public static int $NB_COMPLAINTS_IN_DB = 25;

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

        $developerPrestations = Prestation::select('id')->get();
        $developerPrestationsId = [];
        foreach ($developerPrestations as $developerPrestation) {
            $developerPrestationsId[] = $developerPrestation['id'];
        }

        $complaintsData = [];
        for ($i = 1; $i <= self::$NB_COMPLAINTS_IN_DB; $i++) {
            $complaintsData[] = [
                'user_id'           => $clientsId[array_rand($clientsId, 1)],
                'dev_prestation_id' => $developerPrestationsId[array_rand($developerPrestationsId, 1)],
                'complaint'         => fake()->realTextBetween(15, 100),
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ];
        }

        DB::table('complaints')->insert(
            $complaintsData
        );
    }
}
