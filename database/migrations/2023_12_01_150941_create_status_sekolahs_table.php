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
        Schema::create('status_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id');
            $table->foreign('sekolah_id')
                ->references('id')
                ->on('sekolahs');
            $table->string('status')->default('baik'); // BAIK, RUSAK RINGAN, RUSAK BERAT, DALAM PEMBANGUNAN, DALAM RENOVASI
            $table->date('tanggal_data');
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
        Schema::dropIfExists('status_sekolahs');
    }
};
