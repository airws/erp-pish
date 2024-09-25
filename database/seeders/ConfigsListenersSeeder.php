<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigsListenersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configs_listeners')->insert([
            [
                'listener_id' => 1, // ID слушателя из таблицы users_bids
                'group_programm_id' => 1, // ID группы программы из таблицы group_programs
                'count_clock' => 120,
                'programm_type' => 'Standard',
                'form_education' => 'Online',
                'type_document' => 'Certificate',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
