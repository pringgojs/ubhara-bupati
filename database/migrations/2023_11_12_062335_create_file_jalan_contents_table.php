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
        Schema::connection('file_db')->create('file_jalan_contents', function (Blueprint $table) {
            $table->id();
            $table->string('no_ruas');
            $table->string('nama_ruas');
            $table->string('kecamatan');
            $table->string('panjang');
            $table->string('lebar');
            $table->string('bahan_aspal');
            $table->string('bahan_lapen');
            $table->string('bahan_rabat');
            $table->string('bahan_telford');
            $table->string('bahan_tanah');
            $table->string('kondisi_baik');
            $table->string('kondisi_sedang');
            $table->string('kondisi_rusakringan');
            $table->string('kondisi_rusakberat');

            $table->unsignedBigInteger('file_jalan_id')->nullable();
            $table->foreign('file_jalan_id')
                ->references('id')
                ->on('file_jalans');
            $table->string('status'); // Uploaded; Migrated; Deleted;
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
        Schema::connection('file_db')->dropIfExists('file_jalan_contents');
    }
};
