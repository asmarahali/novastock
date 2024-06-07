<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Structure;

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
            ArticleSeeder::class,
            UsersTableSeeder::class,
            StructureSeeder::class,
            StructureUserTableSeeder::class,
            ProductSeeder::class,
            ChapterSeeder::class,
            FournisseursTableSeeder::class,
            UserRoleSeeder::class,
            RolePermissionSeeder::class,
            ArticleProductSeeder::class,
        ]);
    }
}
