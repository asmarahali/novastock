<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chapters')->insert([
            [
                'name' => 'Remboursement frais',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Matériel et mobilier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fournitures',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Documentation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Habillement personnel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Parc auto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travaux entretien',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Matériel accessoires informatique',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Matériel et mobilier pédagogique',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frais liés aux études de post-graduation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Participation aux organismes nationaux et internationaux',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Activités culturelles sportives et scientifiques aux étudiants',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frais de fonctionnement liées à la recherches scientifique et au développement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
