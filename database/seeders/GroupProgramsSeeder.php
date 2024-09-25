<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('group_programs')->insert([
            [
                'name' => 'Basic Program Group',
                'active' => true,
                'code' => 'basic_group',
                'programm_id' => 1, // ID программы из таблицы programs
                'type' => 'Standard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
