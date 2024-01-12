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
        Schema::create('status_jalans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infrastruktur_jalan_id');
            $table->foreign('infrastruktur_jalan_id')
                ->references('id')
                ->on('infrastruktur_jalans');
            $table->string('status');
            $table->string('tanggal_data');
            $table->float('bahan_aspal');
            $table->float('bahan_lapen');
            $table->float('bahan_rabat');
            $table->float('bahan_telford');
            $table->float('bahan_tanah');
            $table->float('kondisi_baik');
            $table->float('kondisi_sedang');
            $table->float('kondisi_rusakringan');
            $table->float('kondisi_rusakberat');
            $table->float('kondisi_total');
            $table->unsignedBigInteger('file_jalan_id')->nullable();
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
        Schema::dropIfExists('status_jalans');
    }
};
