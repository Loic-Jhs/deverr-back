<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countDeveloper = User::where([
            'role_id'           => 2,
            'is_account_active' => 1,
        ])->count();

        $developersData = [];
        for ($i = 1; $i <= $countDeveloper; $i++) {
            $developersData[] = [
                'user_id'     => $i,
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
