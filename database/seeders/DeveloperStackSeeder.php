<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Stack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // developer_id: de 1 à 8
        // stack_id: de 1 à 11

        DB::table('developer_stacks')->insert([
            [
                'developer_id'     => 1,
                'stack_id'         => 1,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 1,
                'stack_id'         => 2,
                'stack_experience' => 15,
                'is_primary'       => 1,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 1,
                'stack_id'         => 8,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 2,
                'stack_id'         => 4,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 2,
                'stack_id'         => 3,
                'stack_experience' => 15,
                'is_primary'       => 1,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 2,
                'stack_id'         => 6,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 3,
                'stack_id'         => 1,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 3,
                'stack_id'         => 5,
                'stack_experience' => 15,
                'is_primary'       => 1,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 3,
                'stack_id'         => 7,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 4,
                'stack_id'         => 2,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 4,
                'stack_id'         => 4,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 4,
                'stack_id'         => 5,
                'stack_experience' => 15,
                'is_primary'       => 1,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 4,
                'stack_id'         => 8,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 5,
                'stack_id'         => 11,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 5,
                'stack_id'         => 9,
                'stack_experience' => 15,
                'is_primary'       => 1,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 5,
                'stack_id'         => 8,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
            [
                'developer_id'     => 8,
                'stack_id'         => 10,
                'stack_experience' => rand(1, 15),
                'is_primary'       => 0,
                'created_at'       => '2022-09-25 10:50:12',
                'updated_at'       => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
