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
        Schema::create('pasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pasar_id');
            $table->foreign('jenis_pasar_id')
                ->references('id')
                ->on('jenis_pasars');
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')
                ->references('id')
                ->on('desas');
            $table->string('nama');
            $table->text('deskripsi');
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
        Schema::dropIfExists('pasars');
    }
};
