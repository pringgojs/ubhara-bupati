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
        Schema::create('lampiran_status_jembatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_jembatan_id');
            $table->foreign('status_jembatan_id')
                ->references('id')
                ->on('status_jembatans');
            $table->string('location');
            $table->string('nama_file');
            $table->string('nama_url');
            $table->text('keterangan');
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
        Schema::dropIfExists('lampiran_status_jembatans');
    }
};
