<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeEducationalProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_educational_programs')->insert([
            [
                'name' => 'Bachelor Program',
                'active' => true,
                'code' => 'BACHELOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Master Program',
                'active' => true,
                'code' => 'MASTER',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PhD Program',
                'active' => true,
                'code' => 'PHD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diploma Program',
                'active' => true,
                'code' => 'DIPLOMA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Certificate Program',
                'active' => true,
                'code' => 'CERTIFICATE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
