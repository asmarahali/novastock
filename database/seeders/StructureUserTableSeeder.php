<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StructureUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('structure_user')->insert([
            [
                'structure_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 5,
                'user_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 6,
                'user_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' => 7,
                'user_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'structure_id' =>1 ,
                'user_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'structure_id' =>1,
                'user_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'structure_id' => 3,
                'user_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'structure_id' => 4,
                'user_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
