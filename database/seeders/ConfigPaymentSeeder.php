<?php

namespace Database\Seeders;

use App\Models\MasterData\ConfigPayment;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ConfigPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config_payment = [
            [
                'fee' => '150000',
                'vat' => '20', //vat is percent
            ]
        ];

        ConfigPayment::insert($config_payment);
    }
}
