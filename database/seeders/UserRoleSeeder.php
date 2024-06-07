<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = [
            ['user_id' => 1, 'role_id' => 5],
            ['user_id' => 2, 'role_id' => 5],
            ['user_id' => 3, 'role_id' => 5],
            ['user_id' => 4, 'role_id' => 5],
            ['user_id' => 5, 'role_id' => 5],
            ['user_id' => 6, 'role_id' => 5],
            ['user_id' => 7, 'role_id' => 5],
            ['user_id' => 8, 'role_id' => 4],
            ['user_id' => 9, 'role_id' => 4],
            ['user_id' => 10, 'role_id' => 4],
            ['user_id' => 11, 'role_id' => 4],
           
            // Add more user-role pairs as needed
        ];

        // Insert user_role pairs into the database
        foreach ($userRoles as $userRole) {
            DB::table('user_role')->insert($userRole);
        }
    }
}
