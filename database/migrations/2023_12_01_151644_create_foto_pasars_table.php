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
        Schema::create('foto_pasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foto_pasar_id');
            $table->foreign('foto_pasar_id')
                ->references('id')
                ->on('foto_pasars');
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
        Schema::dropIfExists('foto_pasars');
    }
};
