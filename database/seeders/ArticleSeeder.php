<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Chapter;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapters = Chapter::all();

        $articles = [
            ['nom' => 'Frais de réception', 'tva' => 19, 'chapter_id' => $chapters->get(1)->id ?? null],
            ['nom' => 'Acquisition du matériels et mobiliers de bureaux ', 'tva' => 19, 'chapter_id' => $chapters->get(1)->id ?? null],
            ['nom' => 'Acquisition du matériel de prévision et de sécurité', 'tva' => 19, 'chapter_id' => $chapters->get(2)->id ?? null],
            ['nom' => 'Aquisition de materiel audiovisuel', 'tva' => 19, 'chapter_id' => $chapters->get(3)->id ?? null],
            ['nom' => 'Acquisitions du matériel de reprographie et d imprimante', 'tva' => 19, 'chapter_id' => $chapters->get(4)->id ?? null],
            ['nom' => 'Acquisition et entretien du matériel médicale', 'tva' => 19, 'chapter_id' => $chapters->get(5)->id ?? null],
            ['nom' => 'Papeterie et fournitures de bureaux 1', 'tva' => 19, 'chapter_id' => $chapters->get(6)->id ?? null],
            ['nom' => 'Produit d entretien', 'tva' => 19, 'chapter_id' => $chapters->get(7)->id ?? null],
            ['nom' => 'Fournitures de laboratoires et des ateliers d enseignement et de recherche', 'tva' => 19, 'chapter_id' => $chapters->get(8)->id ?? null],
        ];

        foreach ($articles as $articleData) {
            if ($articleData['chapter_id']) {
                Article::create($articleData);
            }
        }
    }
}

