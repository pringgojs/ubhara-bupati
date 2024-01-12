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
        Schema::create('capaian_indikator_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_kinerja_id');
            $table->foreign('indikator_kinerja_id')
                ->references('id')
                ->on('indikator_kinerjas');
            $table->integer('tahun');
            $table->float('target');
            $table->float('capaian');
            $table->string('satuan');
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
        Schema::dropIfExists('capaian_indikator_kinerjas');
    }
};
