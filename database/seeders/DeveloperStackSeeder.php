<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Stack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperStackSeeder extends Seeder
{
    public static int $NB_DEVELOPER_STACKS_IN_DB = 28;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = Developer::select('id')->get();
        $nbStacksInDB = Stack::select('id')->count();

        $developerId = [];
        foreach ($developers as $developer) {
            $developerId[] = $developer['id'];
        }

        $developerStacksData = [];
        for ($i = 1; $i <= self::$NB_DEVELOPER_STACKS_IN_DB; $i++) {
            $developerStacksData[] = [
                'developer_id'     => $developerId[array_rand($developerId, 1)],
                'stack_id'         => rand(1, $nbStacksInDB),
                'stack_experience' => rand(1, 30),
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ];
        }

        DB::table('developer_stacks')->insert(
            $developerStacksData
        );
    }
}
