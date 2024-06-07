<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Benslimane ',
                'lastname' => 'Sidi Mohamed',
                'email' => 's.benslimane@esi-sba.dz',
                'numero' => '0688381201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Naceri ',
                'lastname' => 'Amina',
                'email' => 'a.naceri@esi-sba.dz',
                'numero' => '0688389201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'firstname' => 'Mohamed Réda ',
                'lastname' => 'Aced ',
                'email' => 'a.aced@esi-sba.dz',
                'numero' => '0588389209',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Amrane',
                'lastname' => 'Abdelkader',
                'email' => 'a.amrane@esi-sba.dz',
                'numero' => '0688189203',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Amar Djamel',
                'lastname' => 'Bensaber',
                'email' => 'ad.bensaber@esi-sba.dz',
                'numero' => '0688189901',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Bedjaoui',
                'lastname' => 'Mohamed',
                'email' => 'm.mohamed@esi-sba.dz',
                'numero' => '0788189201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Malki',
                'lastname' => 'Mimoun',
                'email' => 'm.malki@esi-sba.dz',
                'numero' => '0788389201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'FETITAH',
                'lastname' => 'Omar',
                'email' => 'o.FETITAH@esi-sba.dz',
                'numero' => '0688381301',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'SI MOHAMED',
                'lastname' => 'Nasreddine',
                'email' => 'n.simohamed@esi-sba.dz',
                'numero' => '0688381204',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'KIES',
                'lastname' => 'nadia',
                'email' => 'n.kies@esi-sba.dz',
                'numero' => '0699381201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'ZELMAT',
                'lastname' => 'Fatima',
                'email' => 'f.zelmat@esi-sba.dz',
                'numero' => '0611381201',
                'photo_url' => '',
                'is_active' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
