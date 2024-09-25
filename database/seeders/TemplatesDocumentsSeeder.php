<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatesDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates_documents')->insert([
            [
                'file_id' => 1, // ID файла из таблицы files
                'type_id' => 1, // ID типа шаблона из таблицы types_templates
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
