<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserQualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_qualifications')->insert([
            [
                'name' => 'Bachelor\'s Degree',
                'active' => true,
                'code' => 'BACHELORS_DEGREE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Master\'s Degree',
                'active' => true,
                'code' => 'MASTERS_DEGREE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PhD',
                'active' => true,
                'code' => 'PHD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diploma',
                'active' => true,
                'code' => 'DIPLOMA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Certification',
                'active' => true,
                'code' => 'CERTIFICATION',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
