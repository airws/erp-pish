<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProgramsAndCreateFormEducationProgramm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Создаем таблицу form_education_programm
        Schema::create('form_education_programm', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->unsignedBigInteger('form_education_programm_id')->nullable()->after('type_educational_program_id');
            $table->foreign('form_education_programm_id')->references('id')->on('form_education_programm');
        });

        // Добавляем новое поле в таблицу blocks_programs
        Schema::table('blocks_programs', function (Blueprint $table) {
            $table->string('price')->after('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Удаляем поле из таблицы programs
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['form_education_programm_id']);
            $table->dropColumn('form_education_programm_id');
        });

        // Удаляем таблицу form_education_programm
        Schema::dropIfExists('form_education_programm');

        // Удаляем поле из таблицы blocks_programs
        Schema::table('blocks_programs', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}