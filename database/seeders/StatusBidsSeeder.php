<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusBidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_bids')->insert([
            [
                'name' => 'New',
                'active' => true,
                'code' => 'new',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'In Progress',
                'active' => true,
                'code' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Completed',
                'active' => true,
                'code' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cancelled',
                'active' => false,
                'code' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
