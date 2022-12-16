<?php

namespace Database\Seeders;

use App\Models\MasterData\Consultation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consultation = [
            [
                'name' => 'Jantung Sesak'
            ],
            [
                'name' => 'Tekanan Darah Tinggi'
            ],
            [
                'name' => 'Gangguan Irama Jantung'
            ],
        ];

        Consultation::insert($consultation);
    }
}
