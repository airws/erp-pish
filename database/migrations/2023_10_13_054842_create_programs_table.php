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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price');
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('type_document_id')->unsigned();
            $table->foreign('type_document_id')->references('id')->on('types_document_education');
            $table->integer('count_clock');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
