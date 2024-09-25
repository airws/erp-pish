<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserExtraOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_extra_options')->insert([
            [
                'user_id' => 1, // Убедитесь, что такие пользователи существуют в таблице `users`
                'citizenship' => 'Russian',
                'full_name_in_genitive_case' => 'Ivanov Ivan Ivanovich',
                'number_of_complete_years' => 5,
                'series_and_passport_number' => '1234 567890',
                'date_of_issue' => Carbon::parse('2020-01-01'),
                'issued_by' => 'Passport Office',
                'residence_address' => '123 Main St, Moscow, Russia',
                'telegram_nickname' => '@ivanov',
                'availability_of_education' => 'Higher Education',
                'user_area_of_training_id' => 1, // Убедитесь, что такие записи существуют в таблице `user_area_of_trainings`
                'user_qualification_id' => 1, // Убедитесь, что такие записи существуют в таблице `user_qualifications`
                'series_and_number_of_education_diploma' => 'AB 123456',
                'date_of_issue_of_the_education_document' => Carbon::parse('2019-06-15'),
                'registration_number_educational_document' => 'EDU123456',
                'full_name_on_education_document' => 'Ivanov Ivan Ivanovich',
                'employment_relationship_status' => 'Employed',
                'main_place_of_work' => 'ABC Company',
                'job_title' => 'Software Engineer',
                'position_categories' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
