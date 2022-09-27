<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stacks')->insert([
            'name' => 'PHP',
            'created_at' => "2022-09-25 10:50:12",
            'updated_at' => "2022-09-26 15:25:52"
        ]);
    }
}
