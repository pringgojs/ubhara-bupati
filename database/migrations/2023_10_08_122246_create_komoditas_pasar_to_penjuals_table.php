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
        Schema::create('komoditas_pasar_to_penjuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjual_id');
            $table->foreign('penjual_id')
                ->references('id')
                ->on('penjuals');
            $table->unsignedBigInteger('komoditas_pasar_id');
                $table->foreign('komoditas_pasar_id')
                    ->references('id')
                    ->on('komoditas_pasars');
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
        Schema::dropIfExists('komoditas_pasar_to_penjuals');
    }
};
