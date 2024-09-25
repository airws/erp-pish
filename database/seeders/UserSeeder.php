<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'surname' => 'Jakov',
            'name' => 'Airws',
            'patronymic' => null,
            'email' => 'jakov@airws.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'phone' => '+7 (123) 456-78-90',
            'snils' => '123-456-789 00',
            'active' => true,
            'birthday' => now(),
            'avalible_vo_spo' => true,
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
