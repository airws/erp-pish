<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'Credit Card',
                'active' => true,
                'code' => 'credit_card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Transfer',
                'active' => true,
                'code' => 'bank_transfer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'active' => true,
                'code' => 'paypal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cash',
                'active' => true,
                'code' => 'cash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cryptocurrency',
                'active' => true,
                'code' => 'crypto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
