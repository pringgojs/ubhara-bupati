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
        Schema::create('poli_to_fasyankes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kesehatan_poli_id');
            $table->foreign('kesehatan_poli_id')
                ->references('id')
                ->on('kesehatan_polis');
            $table->unsignedBigInteger('fasyankes_id');
            $table->foreign('fasyankes_id')
                ->references('id')
                ->on('fasyankes');
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
        Schema::dropIfExists('poli_to_fasyankes');
    }
};
