<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    public static int $NB_DEVELOPERS_IN_DB = 150;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = User::where('role_id', 2)->get();
        $developerId = [];
        foreach($developers as $developer) {
            $developerId[] = $developer['id'];
        }

        $developersData = [];
        for ($i = 1; $i <= self::$NB_DEVELOPERS_IN_DB; $i++) {
            $developersData[] = [
                'user_id'     => $developerId[array_rand($developerId, 1)],
                'description' => fake()->realTextBetween(30, 60),
                'experience'  => rand(1, 25),
                'created_at'  => '2022-09-25 10:50:12',
                'updated_at'  => '2022-09-26 15:25:52',
            ];
        }

        DB::table('developers')->insert(
            $developersData
        );
    }
}
