<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            [
                'file_id' => 1, // ID файла из таблицы files
                'type_id' => 1, // ID типа документа из таблицы type_documents
                'status_id' => 1, // ID статуса документа из таблицы status_documents
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
