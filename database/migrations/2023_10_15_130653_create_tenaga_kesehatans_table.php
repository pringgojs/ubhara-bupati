<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenaga_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fasyankes_id');
            $table->foreign('fasyankes_id')
                ->references('id')
                ->on('fasyankes');
            $table->unsignedBigInteger('kesehatan_poli_id'); // Penempatan
            $table->foreign('kesehatan_poli_id')
                ->references('id')
                ->on('kesehatan_polis');
            $table->string('nama');
            $table->string('kepegawaian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenaga_kesehatans');
    }
};
