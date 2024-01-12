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
        Schema::create('lahan_pertanians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')
                ->references('id')
                ->on('desas');
            $table->unsignedBigInteger('anggota_kelompok_masyarakat_tani_id');
            $table->foreign('anggota_kelompok_masyarakat_tani_id')
                ->references('id')
                ->on('anggota_kelompok_masyarakat_tanis');
            $table->unsignedBigInteger('jenis_lahan_id')
                ->references('id')
                ->on('jenis_lahans');
            $table->integer('luas')->default(0);
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
        Schema::dropIfExists('lahan_pertanians');
    }
};
