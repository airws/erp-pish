<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_documents')->insert([
            [
                'name' => 'Contract',
                'active' => true,
                'code' => 'contract',
                'template_id' => 1, // ID шаблона из таблицы files
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
