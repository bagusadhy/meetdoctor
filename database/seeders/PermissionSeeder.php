<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // dashboard
            [
                'title'      => 'dashboard_access',
            ],
            // menu
            [
                'title' => 'master_data_access',
            ],
            [
                'title' => 'operational_access',
            ],
            [
                'title' => 'management_access',
            ],
            // user
            [
                'title'      => 'user_access',
            ],
            [
                'title'      => 'user_table',
            ],
            [
                'title'      => 'user_create',
            ],
            [
                'title'      => 'user_edit',
            ],
            [
                'title'      => 'user_show',
            ],
            [
                'title'      => 'user_delete',
            ],
            // permission
            [
                'title'      => 'permission_access',
            ],
            [
                'title'      => 'permission_table',
            ],
            // role
            [
                'title'      => 'role_access',
            ],
            [
                'title'      => 'role_table',
            ],
            [
                'title'      => 'role_create',
            ],
            [
                'title'      => 'role_edit',
            ],
            [
                'title'      => 'role_show',
            ],
            [
                'title'      => 'role_delete',
            ],
            // type user
            [
                'title'      => 'type_user_access',
            ],
            [
                'title'      => 'type_user_table',
            ],
            // specialist
            [
                'title'      => 'specialist_access',
            ],
            [
                'title'      => 'specialist_table',
            ],
            [
                'title'      => 'specialist_create',
            ],
            [
                'title'      => 'specialist_edit',
            ],
            [
                'title'      => 'specialist_show',
            ],
            [
                'title'      => 'specialist_delete',
            ],
            // consultation
            [
                'title'      => 'consultation_access',
            ],
            [
                'title'      => 'consultation_table',
            ],
            [
                'title'      => 'consultation_create',
            ],
            [
                'title'      => 'consultation_edit',
            ],
            [
                'title'      => 'consultation_show',
            ],
            [
                'title'      => 'consultation_delete',
            ],
            // config payment
            [
                'title'      => 'config_payment_access',
            ],
            [
                'title'      => 'config_payment_table',
            ],
            [
                'title'      => 'config_payment_edit',
            ],
            // doctor
            [
                'title'      => 'doctor_access',
            ],
            [
                'title'      => 'doctor_table',
            ],
            [
                'title'      => 'doctor_create',
            ],
            [
                'title'      => 'doctor_edit',
            ],
            [
                'title'      => 'doctor_show',
            ],
            [
                'title'      => 'doctor_delete',
            ],
            // hospital patient
            [
                'title'      => 'hospital_patient_access',
            ],
            [
                'title'      => 'hospital_patient_table',
            ],
            // appointment
            [
                'title'      => 'appointment_access',
            ],
            [
                'title'      => 'appointment_table',
            ],
            [
                'title'      => 'appointment_show',
            ],
            [
                'title'      => 'appointment_export',
            ],
            // transaction
            [
                'title'      => 'transaction_access',
            ],
            [
                'title'      => 'transaction_table',
            ],
            [
                'title'      => 'transaction_show',
            ],
            [
                'title'      => 'transaction_export',
            ],
        ];

        Permission::insert($permission);
    }
}
