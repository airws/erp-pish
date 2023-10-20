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
        Schema::create('configs_listeners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listener_id')->unsigned();
            $table->foreign('listener_id')->references('id')->on('users_bids');
            $table->unsignedBigInteger('group_programm_id')->unsigned(); // Дополнительная группа
            $table->foreign('group_programm_id')->references('id')->on('group_programs');
            $table->integer('count_clock'); // Объем часов
            $table->string('programm_type', 255); // Вид программы
            $table->string('form_education', 255); // Форма обучения
            $table->string('type_document', 255); // Вид документа
            $table->integer('price'); // Цена
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs_listeners');
    }
};
