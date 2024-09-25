<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks_programs')->insert([
            [
                'name' => 'Core Courses',
                'active' => true,
                'code' => 'core_courses',
                'created_at' => now(),
                'updated_at' => now(),
                'price' => 100,
            ],
            [
                'name' => 'Electives',
                'active' => true,
                'code' => 'electives',
                'created_at' => now(),
                'updated_at' => now(),
                'price' => 100,
            ],
            [
                'name' => 'Specialization',
                'active' => true,
                'code' => 'specialization',
                'created_at' => now(),
                'updated_at' => now(),
                'price' => 100,
            ],
            [
                'name' => 'Capstone Project',
                'active' => true,
                'code' => 'capstone_project',
                'created_at' => now(),
                'updated_at' => now(),
                'price' => 100,
            ],
        ]);
    }
}
