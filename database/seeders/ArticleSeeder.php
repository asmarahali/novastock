<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of articles you want to create
        $numberOfArticles = 15;

        // Create fake articles using the factory
        Article::factory($numberOfArticles)->create();
    }
}
