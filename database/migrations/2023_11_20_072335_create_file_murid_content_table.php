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
        Schema::connection('file_db')->create('file_murid_content', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('jenis_sekolah')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->string('tahun_ajaran')->nullable();
            $table->string('kelas_1')->nullable();
            $table->string('kelas_2')->nullable();
            $table->string('kelas_3')->nullable();
            $table->string('kelas_4')->nullable();
            $table->string('kelas_5')->nullable();
            $table->string('kelas_6')->nullable();

            $table->unsignedBigInteger('file_murid_id');
            $table->foreign('file_murid_id')
                ->references('id')
                ->on('file_murid');
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
        Schema::connection('file_db')->dropIfExists('file_murid_content');
    }
};
