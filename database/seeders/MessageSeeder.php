<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public static int $NB_MESSAGES_IN_DB = 95;

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

        $developers = User::where(
            [
                'is_account_active' => 1,
                'role_id'           => 2,
            ])->get();
        $developerId = [];
        foreach ($developers as $developer) {
            $developerId[] = $developer['id'];
        }

        $messagesData = [];

        for ($i = 1; $i <= self::$NB_MESSAGES_IN_DB; $i++) {
            $messagesData[] = [
                'from_user_id' => $clientsId[array_rand($clientsId, 1)],
                'to_user_id'   => $developerId[array_rand($developerId, 1)],
                'message'      => fake()->realTextBetween(20, 100),
                'created_at'   => '2022-09-25 10:50:12',
                'updated_at'   => '2022-09-26 15:25:52',
            ];
        }

        DB::table('messages')->insert($messagesData);
    }
}
