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
        Schema::create('panen_lahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lahan_pertanian_id');
            $table->foreign('lahan_pertanian_id')
                ->references('id')
                ->on('lahan_pertanians');
            $table->unsignedBigInteger('komoditas_lahan_id');
            $table->foreign('komoditas_lahan_id')
                ->references('id')
                ->on('komoditas_lahans');
            $table->integer('jumlah');
            $table->integer('pendapatan');
            $table->string('bulan_data');
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
        Schema::dropIfExists('panen_lahans');
    }
};
