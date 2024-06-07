<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        if (count($userIds) > 7) {
        DB::table('structures')->insert([
            [
                'name' => 'Direction Générale',
                'responsible_id' => $userIds[1], 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Secretariat Général',
                'responsible_id' => $userIds[2], 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Département du cycle préparatoire',
                'responsible_id' => $userIds[3], 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Département du second Cycle',
                'responsible_id' => $userIds[4],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Direction des Enseignements et des Diplomes',
                'responsible_id' => $userIds[5], 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Direction des Relations Exterieures',
                'responsible_id' => $userIds[6],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Direction de la Formation Doctorale',
                'responsible_id' => $userIds[7],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);} else {
            // Handle the case where there are not enough user IDs
            // For example, you could log an error or use a default user ID
            Log::error('Not enough user IDs for seeding structures');
        }
    }
}
