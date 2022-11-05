<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaints')->insert([
            [
                'order_id' => 1,
                'is_user_complaining' => rand(0, 1),
                'complaint' => "C'est grave non ?",
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 2,
                'is_user_complaining' => rand(0, 1),
                'complaint' => "T'es certain d'être développeur ?",
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 3,
                'is_user_complaining' => rand(0, 1),
                'complaint' => 'Le site ne fonctionne plus, et impossible de joindre le développeur',
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 4,
                'is_user_complaining' => rand(0, 1),
                'complaint' => "Une catastrophe, le site n'est pas terminée et je rencontre divers problèmes",
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'order_id' => 5,
                'is_user_complaining' => rand(0, 1),
                'complaint' => "Je n'ai pas reçu de paiement pour ma prestation",
                'status' => rand(0, 1),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
