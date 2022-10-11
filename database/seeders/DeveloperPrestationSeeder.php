<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Prestation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperPrestationSeeder extends Seeder
{
    public static int $NB_DEV_PRESTATIONS_IN_DB = 35;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = Developer::select('id')->get();
        $nbPrestationsInDB = Prestation::select('id')->count();

        $developerId = [];
        foreach ($developers as $developer) {
            $developerId[] = $developer['id'];
        }

        $devPrestationsData = [];
        for ($i = 1; $i <= self::$NB_DEV_PRESTATIONS_IN_DB; $i++) {
            $devPrestationsData[] = [
                'developer_id'        => $developerId[array_rand($developerId, 1)],
                'description'   => fake()->realTextBetween(35, 65),
                'prestation_id' => rand(1, $nbPrestationsInDB),
                'price'         => fake()->randomFloat(2, 100, 900),
                'created_at'    => '2022-09-25 10:50:12',
                'updated_at'    => '2022-09-26 15:25:52',
            ];
        }

        DB::table('developer_prestations')->insert(
            $devPrestationsData
        );
    }
}
