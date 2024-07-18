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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files');
            $table->unsignedBigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type_documents');
            $table->unsignedBigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status_documents');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
