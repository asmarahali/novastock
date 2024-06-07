<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ArticleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleProducts = [
            ['article_id' => 1, 'product_id' => 1],
            ['article_id' => 1, 'product_id' => 2],
            ['article_id' => 2, 'product_id' => 1],
            ['article_id' => 2, 'product_id' => 3],
            ['article_id' => 3, 'product_id' => 4],
            // Add more article-product pairs as needed
        ];

        // Insert article_product pairs into the database
        DB::table('article_product')->insert($articleProducts);
    }
}
