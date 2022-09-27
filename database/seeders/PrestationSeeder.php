<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prestations')->insert([
            'name' => 'Super presta',
            'created_at' => '2022-09-25 10:50:12',
            'updated_at' => '2022-09-26 15:25:52',
        ]);
    }
}
