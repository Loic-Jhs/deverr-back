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
        DB::table('stacks')->insert([
            [
                'name' => 'PHP',
                'logo' => asset('images/stack_logo/PHP.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'Symfony',
                'logo' => asset('images/stack_logo/SYMFONY.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'Laravel',
                'logo' => asset('images/stack_logo/Laravel.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'React',
                'logo' => asset('images/stack_logo/logo-react.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'Angular',
                'logo' => asset('images/stack_logo/angular.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'HTML',
                'logo' => asset('images/stack_logo/html.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'CSS',
                'logo' => asset('images/stack_logo/css.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'Python',
                'logo' => asset('images/stack_logo/python.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'Flutter',
                'logo' => asset('images/stack_logo/flutter.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'JavaScript',
                'logo' => asset('images/stack_logo/js_logo.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'name' => 'React Native',
                'logo' => asset('images/stack_logo/logo-react.svg'),
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
