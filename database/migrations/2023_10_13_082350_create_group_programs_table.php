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
        Schema::create('group_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->boolean('active')->default(1);
            $table->string('code', 255)->unique();
            $table->unsignedBigInteger('programm_id')->unsigned();
            $table->foreign('programm_id')->references('id')->on('programs'); // Предполагается, что у вас есть таблица "programs" для программ
            $table->string('type', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_programs');
    }
};
