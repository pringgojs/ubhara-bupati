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
        Schema::connection('file_db')->create('file_pengunjung_wisata_content', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('file_pengunjung_wisata_id');
            $table->foreign('file_pengunjung_wisata_id')
                ->references('id')
                ->on('file_pengunjung_wisata');
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
        Schema::connection('file_db')->dropIfExists('file_pengunjung_wisata_content');
    }
};
