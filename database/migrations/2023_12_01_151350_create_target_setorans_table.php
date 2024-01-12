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
        Schema::create('target_setorans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasar_id');
            $table->foreign('pasar_id')
                ->references('id')
                ->on('pasars');
            $table->integer('tahun_anggaran');
            $table->integer('target');
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
        Schema::dropIfExists('target_setorans');
    }
};
