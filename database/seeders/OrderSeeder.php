<?php

namespace Database\Seeders;

use App\Models\DeveloperPrestation;
use App\Models\User;
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
        // client_id: de 16 à 25
        // dev_prestation_id: de 1 à 10

        DB::table('orders')->insert([
            [
                'client_id'         => 23,
                'dev_prestation_id' => 7,
                'is_payed'          => 0,
                'stripe_session_id' => null,
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 17,
                'dev_prestation_id' => 5,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 21,
                'dev_prestation_id' => 1,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 21,
                'dev_prestation_id' => 2,
                'is_payed'          => 0,
                'stripe_session_id' => null,
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 25,
                'dev_prestation_id' => 4,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 20,
                'dev_prestation_id' => 3,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 19,
                'dev_prestation_id' => 10,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 18,
                'dev_prestation_id' => 8,
                'is_payed'          => 1,
                'stripe_session_id' => 'cs_test_a1sF4zktyie8TIeGIh3ioKoEOdVRuw02C6bjz98DxCzylpHJFQs7Mizmbs',
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
            [
                'client_id'         => 18,
                'dev_prestation_id' => 9,
                'is_payed'          => 0,
                'stripe_session_id' => null,
                'reference'         => '2022-09-25 10:50:12$123',
                'created_at'        => '2022-09-25 10:50:12',
                'updated_at'        => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
