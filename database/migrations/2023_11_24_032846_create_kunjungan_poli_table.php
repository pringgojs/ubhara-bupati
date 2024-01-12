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
        Schema::create('kunjungan_poli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kesehatan_poli_id');
            $table->foreign('kesehatan_poli_id')
                ->references('id')
                ->on('kesehatan_polis');
            $table->integer('total_kunjungan');
            $table->date('tanggal_kunjungan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan_poli');
    }
};
