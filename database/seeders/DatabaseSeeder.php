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
            RoleSeeder::class,
            UserSeeder::class,
            StackSeeder::class,
            DeveloperSeeder::class,
            PrestationSeeder::class,
            OrderSeeder::class,
            DeveloperPrestationSeeder::class,
            DeveloperStackSeeder::class,
            MessageSeeder::class,
            ReviewSeeder::class,
            TransactionSeeder::class,
            ComplaintSeeder::class,
        ]);
    }
}
