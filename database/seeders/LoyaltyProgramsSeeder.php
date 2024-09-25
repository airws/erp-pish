<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoyaltyProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loyalty_programs')->insert([
            [
                'name' => 'Bronze Membership',
                'price' => 1000,
                'percent' => 5,
                'code' => 'BRONZE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silver Membership',
                'price' => 2000,
                'percent' => 10,
                'code' => 'SILVER',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gold Membership',
                'price' => 5000,
                'percent' => 15,
                'code' => 'GOLD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Platinum Membership',
                'price' => 10000,
                'percent' => 20,
                'code' => 'PLATINUM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diamond Membership',
                'price' => null,
                'percent' => 25,
                'code' => 'DIAMOND',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
