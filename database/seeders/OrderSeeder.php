<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'client_id' => 2,
            'dev_prestation_id' => 1,
            'is_payed' => 0,
            'created_at' => "2022-09-25 10:50:12",
            'updated_at' => "2022-09-26 15:25:52"
        ]);
    }
}
