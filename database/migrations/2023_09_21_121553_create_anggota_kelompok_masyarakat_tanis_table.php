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
        Schema::create('anggota_kelompok_masyarakat_tanis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kmt_id');
            $table->foreign('kmt_id')
                ->references('id')
                ->on('kelompok_masyarakat_tanis');
            $table->string('nama');
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nik')->nullable();
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
        Schema::dropIfExists('anggota_kelompok_masyarakat_tanis');
    }
};
