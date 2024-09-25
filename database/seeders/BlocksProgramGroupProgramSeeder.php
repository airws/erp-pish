<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksProgramGroupProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks_program_group_program')->insert([
            [
                'group_program_id' => 1, // ID группы программ из таблицы group_programs
                'blocks_program_id' => 1, // ID блока программы из таблицы blocks_programs
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
