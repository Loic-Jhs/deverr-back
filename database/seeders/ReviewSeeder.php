<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'client_id' => '2',
            'order_id' => '1',
            'comment' => "Sed eget congue nunc. Aliquam fermentum purus ante, pulvinar tempor massa dignissim quis. Aenean nec ligula vitae nisi laoreet pretium. Aenean rutrum ultrices dapibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus fringilla metus quis fermentum dignissim. Quisque dignissim ligula vel mi bibendum, et feugiat est auctor. Aliquam malesuada, massa eget gravida auctor, nulla eros rhoncus lacus, at vehicula magna justo a neque.",
            'rating' => "4",
            'created_at' => "2022-09-25 10:50:12",
            'updated_at' => "2022-09-26 15:25:52"
        ]);
    }
}
