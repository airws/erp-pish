<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OrderSeeder::class,
            PayerDetailsSeeder::class,
            StatusBidsSeeder::class,
            TypesDocumentEducationSeeder::class,
            TypeEducationalProgramsSeeder::class,
            FormEducationProgramSeeder::class,
            ProgramsSeeder::class,
            BidsSeeder::class,
            UsersBidsSeeder::class,
            BlocksProgramsSeeder::class,
            GroupProgramsSeeder::class,
            BlocksProgramGroupProgramSeeder::class,
            ConfigsListenersSeeder::class,
            FilesSeeder::class,
            StatusDocumentsSeeder::class,
            TypeDocumentsSeeder::class,
            DocumentsSeeder::class,
            PaymentMethodsSeeder::class,
            PaymentsSeeder::class,
            LoyaltyProgramsSeeder::class,
            TypesTemplatesSeeder::class,
            TemplatesDocumentsSeeder::class,
            UserAreaOfTrainingsSeeder::class,
            UserQualificationsSeeder::class,
            UserExtraOptionsSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
