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
        Schema::create('pengunjung_wisatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tempat_wisata_id');
            $table->foreign('tempat_wisata_id')
                ->references('id')
                ->on('tempat_wisatas');
            $table->string('tanggal_data');
            $table->integer('harga');
            $table->integer('pengunjung');
            $table->string('keterangan');
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
        Schema::dropIfExists('pengunjung_wisatas');
    }
};
