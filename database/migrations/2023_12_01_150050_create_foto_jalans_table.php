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
        Schema::create('foto_jalans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infrastruktur_jalan_id');
            $table->foreign('infrastruktur_jalan_id')
                ->references('id')
                ->on('infrastruktur_jalans');
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
        Schema::dropIfExists('foto_jalans');
    }
};
