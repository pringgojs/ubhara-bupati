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
        Schema::create('foto_jembatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infrastruktur_jembatan_id');
            $table->foreign('infrastruktur_jembatan_id')
                ->references('id')
                ->on('infrastruktur_jembatans');
            $table->string('location');
            $table->string('file_name');
            $table->string('keterangan');
            $table->string('status');
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
        Schema::dropIfExists('foto_jembatans');
    }
};
