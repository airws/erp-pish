<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesDocumentEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types_document_education')->insert([
            [
                'name' => 'Diploma',
                'active' => true,
                'code' => 'diploma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Certificate',
                'active' => true,
                'code' => 'certificate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transcript',
                'active' => true,
                'code' => 'transcript',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'License',
                'active' => true,
                'code' => 'license',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
