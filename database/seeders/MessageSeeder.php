<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public static int $NB_MESSAGES_IN_DB = 15;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messagesData = [];
        for ($i = 1; $i <= self::$NB_MESSAGES_IN_DB; $i++) {
            $messagesData[] = [
                'from_user_id' => User::all()->random()->id,
                'to_developer_id' => Developer::all()->random()->id,
                'message' => fake()->realTextBetween(10, 20),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ];
        }

        DB::table('messages')->insert($messagesData);
    }
}
