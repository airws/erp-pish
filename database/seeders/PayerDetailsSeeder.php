<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payer_details')->insert([
            [
                'type_face' => 'ООО',
                'order_id' => 1,
                'inn' => '123456789012',
                'kpp' => '123456789',
                'ogrn' => '1234567890123',
                'city' => 'Москва',
                'index' => '123456',
                'abbreviation' => 'ООО "Рога и Копыта"',
                'full_ur_name' => 'Общество с ограниченной ответственностью "Рога и Копыта"',
                'fio_rod_head' => 'Иванов Иван Иванович',
                'ur_address' => 'ул. Пушкина, д. Колотушкина, д. 1, стр. 2',
                'actual_address' => 'ул. Пушкина, д. Колотушкина, д. 1, стр. 3',
                'bik_bank' => '123456789',
                'name_bank' => 'Банк "Примерный"',
                'rc' => '12345678901234567890',
                'ks' => '09876543210987654321',
                'kbk' => '12345678901234567890',
                'personal_account' => '98765432109876543210',
                'fio_head' => 'Петров Петр Петрович',
                'job_title' => 'Генеральный директор',
                'acts_basis' => 'Устав',
                'concluded_accordance' => 'Договор №1 от 01.01.2024',
                'surname' => 'Сидоров',
                'name' => 'Сидор',
                'patronymic' => 'Сидорович',
                'snils' => '123-456-789 00',
                'registration_address' => 'г. Москва, ул. Ленина, д. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
