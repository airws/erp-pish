<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('files')->insert([
            [
                'name' => 'User Profile Picture',
                'path' => 'uploads/profile_pictures/user1.jpg',
                'disk' => 'public',
                'type' => 'image/jpeg',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
