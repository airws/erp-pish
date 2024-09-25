<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormEducationProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('form_education_programm')->insert([
            [
                'name' => 'Full-time',
                'code' => 'FULL_TIME',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Part-time',
                'code' => 'PART_TIME',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Distance Learning',
                'code' => 'DISTANCE_LEARNING',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Evening Classes',
                'code' => 'EVENING_CLASSES',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Online',
                'code' => 'ONLINE',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
