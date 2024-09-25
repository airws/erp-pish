<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'name' => 'Software Engineering',
                'price' => 50000,
                'active' => true,
                'type_document_id' => 1, // ID типа документа из таблицы types_document_education
                'count_clock' => 1200,
                'created_at' => now(),
                'updated_at' => now(),
                'type_educational_program_id' => 1,
                'form_education_programm_id' => 1
            ]
        ]);
    }
}
