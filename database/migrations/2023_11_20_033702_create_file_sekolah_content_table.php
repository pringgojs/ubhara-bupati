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
        Schema::connection('file_db')->create('file_sekolah_content', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('desa_kelurahan')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('kondisi')->nullable();

            $table->unsignedBigInteger('file_sekolah_id');
            $table->foreign('file_sekolah_id')
                ->references('id')
                ->on('file_sekolah');
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
        Schema::connection('file_db')->dropIfExists('file_sekolah_content');
    }
};
