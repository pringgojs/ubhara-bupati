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
        Schema::create('setoran_pasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_setoran_id');
            $table->foreign('target_setoran_id')
                ->references('id')
                ->on('target_setorans');
            $table->integer('setoran_terkumpul'); // Total Setoran Terkumpul
            $table->string('tanggal_data');
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
        Schema::dropIfExists('setoran_pasars');
    }
};
