<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use Faker to generate dummy data
        $faker = Faker::create();

        // Create 15 users
        for ($i = 0; $i < 15; $i++) {
            User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'is_active' => true,
                'role' => $faker->randomElement(['Administrateur', 'ASA', 'Magasinier', 'Consommateur', 'RSR', 'Directeur']),
                'password' => Hash::make('password'), // Default password for all users
            ]);
        }
    }
}
