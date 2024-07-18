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
        Schema::create('payer_details', function (Blueprint $table) {
            $table->id();
            $table->string('type_face', 100);
            $table->unsignedBigInteger('order_id')->nullable(false);
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('inn', 20);
            $table->string('kpp', 20);
            $table->string('ogrn', 20);
            $table->string('city', 190);
            $table->string('index', 255);
            $table->string('abbreviation', 255);
            $table->text('full_ur_name');
            $table->string('fio_rod_head', 255);
            $table->string('ur_address', 255);
            $table->string('actual_address', 255);
            $table->string('bik_bank', 50);
            $table->string('name_bank', 255);
            $table->string('rc', 50);
            $table->string('ks', 50);
            $table->string('kbk', 255);
            $table->string('personal_account', 255);
            $table->string('fio_head', 255);
            $table->string('job_title', 255);
            $table->string('acts_basis', 255);
            $table->string('concluded_accordance', 255);
            $table->string('surname', 100);
            $table->string('name', 100);
            $table->string('patronymic', 100);
            $table->string('snils', 15);
            $table->string('registration_address', 255);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payer_details');
    }
};
