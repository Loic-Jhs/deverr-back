<?php

namespace Database\Seeders;

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
        $logo = [
            asset('images/stack_logo/php.png'),
            asset('images/stack_logo/js.png'),
        ];
        DB::table('stacks')->insert([
            [
                'name'       => 'PHP',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'Symfony',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'Laravel',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'React',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'Angular',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'HTML',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'CSS',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'Python',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'Flutter',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'JavaScript',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name'       => 'React Native',
                'logo'      => $logo[rand(0, 1)],
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
