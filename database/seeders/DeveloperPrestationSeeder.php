<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperPrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developer_prestations')->insert([
            'dev_id' => 1,
            'description' => "is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'prestation_id' => 1,
            'price' => '600.25',
            'created_at' => '2022-09-25 10:50:12',
            'updated_at' => '2022-09-26 15:25:52',
        ]);
    }
}
