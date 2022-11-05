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
                'order_id' => 6,
                'rating' => 1,
                'comment' => "Travail bâclé.. dommage",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 12,
                'rating' => 5,
                'comment' => "Professionnalisme au rendez-vous, je suis très satisfait du travail réalisé",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 15,
                'rating' => 5,
                'comment' => "Professionnalisme au rendez-vous, je suis très satisfait du travail réalisé",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 16,
                'rating' => 3,
                'comment' => "Un très beau site vitrine pour partager ma passion de la cuisine",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 17,
                'rating' => 1,
                'comment' => "Il a créé encore plus de bug qu'avant...",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
