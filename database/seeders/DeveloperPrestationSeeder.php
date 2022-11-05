<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Prestation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperPrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // developer_id: de 1 à 10.
        // prestation_type_id: de 1 à 9.

        DB::table('developer_prestations')->insert([
            [
                'developer_id' => 1,
                'prestation_type_id' => 9,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Pas de panique, si votre site à un problème, vous pouvez m'appeler (pas après 18h, c'est l'heure de l'apéro)",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 1,
                'prestation_type_id' => 1,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Beaucoup d'entreprise sont présentes sur internet, pourquoi pas vous? Je m'occupe de la création de votre site vitrine. Nous élaborerons ensemble votre cahier des charges",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 2,
                'prestation_type_id' => 3,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Envie d'être présent sur la toile et mettre en vente vos produits? Je vous propose de réaliser votre site e-commerce !",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 2,
                'prestation_type_id' => 5,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Besoin d'un logiciel de type ERP pour vous accompagner dans votre activité? Discutons en autour d'un café (ou d'un appel meet, si vous préférez)",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 3,
                'prestation_type_id' => 7,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Je vous propose de créer votre application mobile, pour le succès, ça c'est entre vos mains...",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 3,
                'prestation_type_id' => 2,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Les skyblog C'EST FINI ! Ne perdez plus votre temps, partagez moi votre projet et je m'occupe du reste",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 4,
                'prestation_type_id' => 3,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => 'Vous souhaitez faire connaître votre activité ? Un site vitrine ça vous tente ?',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 4,
                'prestation_type_id' => 4,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Besoin d'une création ou refonte d'une page d'accueil? Mes compétences de développeur et de webdesigner sauront vous ravir",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 5,
                'prestation_type_id' => 3,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => 'Et si on travaillait ensemble pour vous permettre de vendre vos produits plus facilement? :)',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 5,
                'prestation_type_id' => 6,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Hep hep hep, besoin d'un CRM? Ne cherchez plus, je suis la !",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 6,
                'prestation_type_id' => 8,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Vous ne savez pas ce qu'est une API? Pas besoin de me contacter, si vous savez ce que c'est, on va pouvoir s'entendre et discuter de votre projet",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 6,
                'prestation_type_id' => 7,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Une application mobile pour gérer votre entreprise n'importe où ? Ne cherchez plus je suis là pour vous",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 7,
                'prestation_type_id' => 5,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Je créé depuis maintenant plus de 4 ans des logiciels de type ERP pour la gestion RH d'une entreprise par exemple",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 8,
                'prestation_type_id' => 3,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => "Avoir votre propre site et pouvoir y vendre vos produits ? N'attendez plus et travaillons ensembles ?",
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 9,
                'prestation_type_id' => 9,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => 'Une erreur 500 ? Pas de panique je suis là pour vous de 9h à 20h',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 9,
                'prestation_type_id' => 1,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => 'Un site vitrine à votre image ? Je vous propose un service de qualité',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'developer_id' => 10,
                'prestation_type_id' => 9,
                'price' => fake()->randomFloat(2, 100, 900),
                'description' => 'SOS BUG ? BUG BUSTER ! Disponible du lundi au samedi de 8h à 22h.',
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
