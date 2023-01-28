<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Operational\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = [
            [
                'specialist_id' => 4,
                'user_id' => 2,
                'name' => 'Dr. Bagus',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/5F6q2pklEZTk66yCJLRh6QCNAW0xKHzul2y7Bmn5.jpg',
            ],
            [
                'specialist_id' => 1,
                'user_id' => 3,
                'name' => 'Dr. Herman',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/W0FxCID2OvOW5pLj6DbllCVXp5M88mpTYu2nG5UE.jpg',
            ],
            [
                'specialist_id' => 5,
                'user_id' => 4,
                'name' => 'Dr. Ari',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/gv3C31jJbFt92LnWdjPHOnIqPA4qyH1jrFXeRrlA.jpg',
            ],
            [
                'specialist_id' => 2,
                'user_id' => 5,
                'name' => 'Dr. Andre',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/WBd6WSxHCAzEv0GIXBRjGKHFOVKhfy2D4AfckNsY.jpg',
            ],
            [
                'specialist_id' => 3,
                'user_id' => 2,
                'name' => 'Dr. Ander',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/5F6q2pklEZTk66yCJLRh6QCNAW0xKHzul2y7Bmn5.jpg',
            ],
            [
                'specialist_id' => 1,
                'user_id' => 3,
                'name' => 'Dr. Muti',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/W0FxCID2OvOW5pLj6DbllCVXp5M88mpTYu2nG5UE.jpg',
            ],
            [
                'specialist_id' => 2,
                'user_id' => 4,
                'name' => 'Dr. Sapir',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/gv3C31jJbFt92LnWdjPHOnIqPA4qyH1jrFXeRrlA.jpg',
            ],
            [
                'specialist_id' => 3,
                'user_id' => 5,
                'name' => 'Dr. Elsa',
                'fee' => 1000000,
                'photo' => 'assets/file-doctor/WBd6WSxHCAzEv0GIXBRjGKHFOVKhfy2D4AfckNsY.jpg',
            ],
        ];

        Doctor::insert($doctor);
    }
}
