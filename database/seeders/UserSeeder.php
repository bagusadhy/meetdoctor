<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Bagus',
                'email' => 'bagus@gmail.com',
                'password' => Hash::make('bagus@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Herman',
                'email' => 'herman@gmail.com',
                'password' => Hash::make('herman@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Ari',
                'email' => 'ari@gmail.com',
                'password' => Hash::make('ari@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Andre',
                'email' => 'andre@gmail.com',
                'password' => Hash::make('andre@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Ander',
                'email' => 'ander@gmail.com',
                'password' => Hash::make('ander@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Muti',
                'email' => 'muti@gmail.com',
                'password' => Hash::make('muti@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Sapir',
                'email' => 'sapir@gmail.com',
                'password' => Hash::make('sapir@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
            [
                'name' => 'Dr. Elsa',
                'email' => 'elsa@gmail.com',
                'password' => Hash::make('elsa@gmail.com'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'remember_token' => null,
            ],
        ];

        User::insert($user);
    }
}
