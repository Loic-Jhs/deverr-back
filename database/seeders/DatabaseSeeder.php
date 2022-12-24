<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StackSeeder::class,
            DeveloperSeeder::class,
            PrestationTypesSeeder::class,
            DeveloperPrestationSeeder::class,
            OrderSeeder::class,
            DeveloperStackSeeder::class,
            MessageSeeder::class,
            ReviewSeeder::class,
            ComplaintSeeder::class,
        ]);
    }
}
