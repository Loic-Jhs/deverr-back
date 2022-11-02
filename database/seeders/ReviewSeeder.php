<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'order_id' => 1,
                'rating' => 0,
                'comment' => fake()->text(22),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'rating' => 4,
                'comment' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'rating' => 2,
                'comment' => fake()->text(12),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
