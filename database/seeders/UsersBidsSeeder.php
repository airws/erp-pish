<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersBidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_bids')->insert([
            [
                'user_id' => 1, // ID пользователя из таблицы users
                'bid_id' => 1, // ID заявки из таблицы bids
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
