<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Предположим, что у тебя есть пользователи с ID 1 и 2 в таблице `users`
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'price' => 1000,
                'manager_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
