<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fournisseurs')->insert([
            [
                'name' => 'EURL YAPAP',
                'adresse' => '28 Rue Ghrab Mohamed Mascara',
                'number' => '048741717',
                'email' =>'eurl@eurl.com',
                'NIS' => '',
                'NIF' => '11310',
                'RC' => '31/03-0112265 B 23',
            ],
            [
                'name' => 'GPSB BENMOUSSA',
                'adresse' => '25 Rue Amir Abdelkader Oran',
                'number' => '048764545',
                'email' =>'GPSB@GPSB.com',
                'NIS' => '',
                'NIF' => '2733101',
                'RC' => '22/00.0121096 A 22',
            ],
            [
                'name' => 'EXTREME SECURITE PREVENTICA',
                'adresse' => '78 Rue Aboubakr Essadik Sidi Bel Abbes',
                'number' => '048785656',
                'email' =>'EXTREME@EXTREME.com',
                'NIS' => '1922010000179',
                'NIF' => '1922',
                'RC' => '22/00.0233555 B 17',
            ],
            [
                'name' => 'MACIF FOURNITURE',
                'adresse' => '25 Cité khaled Hamou Sidi Bel Abbes',
                'number' => '048749393',
                'email' => 'MACIF@MACIF.com',
                'NIS' => '19972210006147',
                'NIF' => '19722',
                'RC' => '22/00-0173963 A 21',
            ],
        ]);
    }
}
