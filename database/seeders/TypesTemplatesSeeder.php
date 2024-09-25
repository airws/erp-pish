<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types_templates')->insert([
            [
                'name' => 'Invoice Template',
                'active' => true,
                'code' => 'INVOICE_TPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contract Template',
                'active' => true,
                'code' => 'CONTRACT_TPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Receipt Template',
                'active' => true,
                'code' => 'RECEIPT_TPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Report Template',
                'active' => true,
                'code' => 'REPORT_TPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Letterhead Template',
                'active' => true,
                'code' => 'LETTERHEAD_TPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
