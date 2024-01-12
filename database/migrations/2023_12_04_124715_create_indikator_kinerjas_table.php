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
        Schema::create('indikator_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_kinerja_group_id');
            $table->foreign('indikator_kinerja_group_id')
                ->references('id')
                ->on('indikator_kinerja_groups');
            $table->string('aspek');
            $table->string('skpd');
            $table->string('sumber');
            $table->string('keterangan');
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
        Schema::dropIfExists('indikator_kinerjas');
    }
};
