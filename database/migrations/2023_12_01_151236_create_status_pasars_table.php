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
        Schema::create('status_pasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasar_id');
            $table->foreign('pasar_id')
                ->references('id')
                ->on('pasars');
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
        Schema::dropIfExists('status_pasars');
    }
};
