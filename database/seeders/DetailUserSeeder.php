<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\DetailUser;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'user_id' => 1,
                'type_user_id' => 1,
                'contact' => null,
                'address' => null,
                'photo' => null,
                'gender' => null,
            ]
        ];

        DetailUser::insert($detail_user);
    }
}
