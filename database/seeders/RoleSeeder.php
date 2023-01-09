<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'title'      => 'Super Admin', // 1
            ],
            [
                'title'      => 'Admin', // 2
            ],
            [
                'title'      => 'Staff Hospital', // 3
            ],
            [
                'title'      => 'Doctor', // 4
            ],
            [
                'title'      => 'Patient', // 5
            ],
        ];

        Role::insert($role);
    }
}
