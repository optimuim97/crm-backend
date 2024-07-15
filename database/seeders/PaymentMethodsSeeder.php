<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $paymentMethods = [
            ['designation' => 'CHEQUE', 'created_at' => now(), 'updated_at' => now()],
            ['designation' => 'ESPECE', 'created_at' => now(), 'updated_at' => now()],
            ['designation' => 'CARTE BANCAIRE', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }
}
