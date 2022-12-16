<?php

namespace Database\Seeders;

use App\Models\MasterData\TypeUser;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_user = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'dokter'
            ],
            [
                'name' => 'pasien'
            ],
        ];

        TypeUser::insert($type_user);
    }
}
