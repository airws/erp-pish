<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_extra_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('citizenship', 255);
            $table->string('full_name_in_genitive_case', 255);
            $table->integer('number_of_complete_years');
            $table->string('series_and_passport_number', 255);
            $table->date('date_of_issue');
            $table->text('issued_by');
            $table->text('residence_address');
            $table->string('telegram_nickname', 255);
            $table->string('availability_of_education', 255);
            $table->unsignedBigInteger('user_area_of_training_id');
            $table->foreign('user_area_of_training_id')->references('id')->on('user_area_of_trainings');

            $table->unsignedBigInteger('user_qualification_id');
            $table->foreign('user_qualification_id')->references('id')->on('user_qualifications');

            $table->string('series_and_number_of_education_diploma', 255);
            $table->date('date_of_issue_of_the_education_document');
            $table->string('registration_number_educational_document', 255);
            $table->string('full_name_on_education_document', 255);
            $table->string('employment_relationship_status', 255);
            $table->string('main_place_of_work', 255);
            $table->string('job_title', 255);
            $table->string('position_categories', 255);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_extra_options');
    }
};
