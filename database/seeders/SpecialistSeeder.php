<?php

namespace Database\Seeders;

use App\Models\MasterData\Specialist;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialist = [
            [
                'name' => 'Dermatology',
                'price' => '250000',
            ],
            [
                'name' => 'Dentist',
                'price' => '450000',
            ],
            [
                'name' => 'Endodontics',
                'price' => '150000',
            ],
            [
                'name' => 'General Dentistry',
                'price' => '120000',
            ],
            [
                'name' => 'Oral and Maxillofacial Surgery',
                'price' => '80000',
            ],
        ];

        Specialist::insert($specialist);

        // DB::table('specialist')->insert($specialist);
    }
}
