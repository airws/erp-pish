<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_documents')->insert([
            [
                'name' => 'Draft',
                'active' => true,
                'code' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pending Review',
                'active' => true,
                'code' => 'pending_review',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Approved',
                'active' => true,
                'code' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rejected',
                'active' => true,
                'code' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Archived',
                'active' => false,
                'code' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
