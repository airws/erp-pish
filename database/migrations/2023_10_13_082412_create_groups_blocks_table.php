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
        Schema::create('blocks_program_group_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_program_id')->unsigned();
            $table->foreign('group_program_id')->references('id')->on('group_programs');
            $table->unsignedBigInteger('blocks_program_id')->unsigned();
            $table->foreign('blocks_program_id')->references('id')->on('blocks_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks_program_group_program');
    }
};
