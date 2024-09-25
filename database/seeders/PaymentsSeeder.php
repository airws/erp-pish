<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'document_id' => 1, // ID документа из таблицы documents (может быть null)
                'bid_id' => 1, // ID заявки из таблицы bids
                'payment_method_id' => 1, // ID способа оплаты из таблицы payment_methods
                'percent' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
