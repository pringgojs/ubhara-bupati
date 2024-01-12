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
        Schema::connection('file_db')->create('file_guru_content', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->string('desa_kelurahan')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->string('nama_sekolah');
            $table->string('status_guru')->nullable();

            $table->unsignedBigInteger('file_guru_id');
            $table->foreign('file_guru_id')
                ->references('id')
                ->on('file_guru');
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
        Schema::connection('file_db')->dropIfExists('file_guru_content');
    }
};
