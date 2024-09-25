<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bids')->insert([
            [
                'order_id' => 1, // ID заказа из таблицы orders
                'status_id' => 1, // ID статуса из таблицы status_bids
                'program_id' => 1, // ID программы из таблицы programs
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
