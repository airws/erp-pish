<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAreaOfTrainingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_area_of_trainings')->insert([
            [
                'name' => 'Software Development',
                'active' => true,
                'code' => 'SOFTWARE_DEV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Data Science',
                'active' => true,
                'code' => 'DATA_SCIENCE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Digital Marketing',
                'active' => true,
                'code' => 'DIGITAL_MARKETING',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Management',
                'active' => true,
                'code' => 'PROJECT_MANAGEMENT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cybersecurity',
                'active' => true,
                'code' => 'CYBERSECURITY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
