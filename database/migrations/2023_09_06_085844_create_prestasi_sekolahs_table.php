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
        Schema::create('prestasi_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id')
                ->references('id')
                ->on('sekolahs');
            $table->string('nama');
            $table->string('rank');
            $table->string('level');
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
        Schema::dropIfExists('prestasi_sekolahs');
    }
};
