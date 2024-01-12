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
        Schema::connection('file_db')->create('file_kelompok_tani_content', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('nik')->nullable();
            $table->string('nama_kelompok')->nullable();
            $table->float('luas_lahan')->default(0);
            $table->string('jenis_lahan')->nullable();
            $table->string('komoditas')->nullable();

            $table->unsignedBigInteger('file_kelompok_tani_id');
            $table->foreign('file_kelompok_tani_id')
                ->references('id')
                ->on('file_kelompok_tani');
            $table->string('status'); // Uploaded; Migrated; Deleted;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('file_db')->dropIfExists('file_kelompok_tani_content');
    }
};
