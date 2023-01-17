<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user_id: (Développeur dans la table User) de 13 à 22
        DB::table('developers')->insert([
            [
                'user_id' => 13,
                'description' => "Jeune développeur sortie d'école, je souhaite travailler sur des projets concrets afin de parfaire mon expérience en passant par Deverr.",
                'avatar' => asset('/images/avatar/14/random1.jpeg'),
                'years_of_experience' => 12,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 14,
                'description' => "Aujourd'hui freelance, j'ai longuement travaillé dans l'industrie. Grâce ma polyvalence je suis capable de travailler sur tout types de projets. N'hésitez pas à me solliciter pour vos projets !",
                'avatar' => asset('/images/avatar/15/random2.jpeg'),
                'years_of_experience' => 4,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 15,
                'description' => "J'aime beaucoup développer des jolies frontend, mais rien ne m'empêche de travailler aussi côté back. Mes compétences full stack me permettent de mener à bien les projets qui me sont confié !",
                'avatar' => asset('/images/avatar/16/random3.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 16,
                'description' => "Si vos projets concernent l'IA et/ou le machine learning, c'est par ici que ça se passe !",
                'avatar' => asset('/images/avatar/17/random4.jpeg'),
                'years_of_experience' => 9,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 17,
                'description' => 'Votre base de données vous pose des problèmes? Vous avez une idée de site, mais pas le temps de vous en occuper? Contactez moi et je verrai ce que je peux faire pour vous',
                'avatar' => asset('/images/avatar/18/random5.jpeg'),
                'years_of_experience' => 22,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 18,
                'description' => 'Spécialiste wordpress, je peux vous créer un site de A à Z ou simplement ajouter de nouvelle fonctionnalité sur un projet existant. Disponible en journée, de 8h à 18h',
                'avatar' => asset('/images/avatar/19/random6.jpeg'),
                'years_of_experience' => 2,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 19,
                'description' => "Tout juste sorti de mes études, je recherches mes premières missions pour appliquer tout ce que j'ai pu apprendre. Une préférence pour le travail en équipe, mais je ne suis pas fermé à toute autre proposition",
                'avatar' => asset('/images/avatar/20/random7.jpeg'),
                'years_of_experience' => 13,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 20,
                'description' => 'Un peu de temps libre pour quelques mois, je vous propose mes services pour réaliser vos projets. Plutôt disponible dans la soirée et les weekend',
                'avatar' => asset('/images/avatar/21/random8.jpeg'),
                'years_of_experience' => 7,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 21,
                'description' => "Développeur depuis 1 an, je suis actuellement à la recherche de mission (courte dans l'idéal) pour mettre à profit mon savoir. N'hésitez pas à me contacter pour tout type de projet, je réponds assez rapidement !",
                'avatar' => asset('/images/avatar/22/random9.jpeg'),
                'years_of_experience' => 1,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
            [
                'user_id' => 22,
                'description' => 'Développeur depuis 14 ans, je suis actuellement à la recherche de mission',
                'avatar' => asset('/images/avatar/22/random9.jpeg'),
                'years_of_experience' => 14,
                'created_at' => '2022-09-25 10:50:12',
                'updated_at' => '2022-09-26 15:25:52',
            ],
        ]);
    }
}
