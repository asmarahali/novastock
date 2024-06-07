<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Duplicopieur',
                'description' => '- Monochrome - A3',
                'quantity' => 10,
                'price' => 1000.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duplicopieur',
                'description' => '- Monochrome - A4',
                'quantity' => 10,
                'price' => 900.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'KYOCERA FS-1025 MFP',
                'quantity' => 10,
                'price' => 1500.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'Taskalfa 1800',
                'quantity' => 10,
                'price' => 2000.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'monochrome multifonction',
                'quantity' => 10,
                'price' => 1200.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'XEROX WorkCentre 5335',
                'quantity' => 10,
                'price' => 2500.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'Kyocera KM -1635/2035',
                'quantity' => 10,
                'price' => 1300.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photocopieur',
                'description' => 'LEX MARK MX510',
                'quantity' => 10,
                'price' => 1100.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photorecepteur ',
                'description' => 'pour panasonic dp 8060',
                'quantity' => 10,
                'price' => 800.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Photorecepteur',
                'description' => 'pour XEROX Workcenter 5230',
                'quantity' => 10,
                'price' => 850.00,
                'min' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
