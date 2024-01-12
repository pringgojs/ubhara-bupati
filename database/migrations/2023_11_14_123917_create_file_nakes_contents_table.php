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
        Schema::connection('file_db')->create('file_nakes_contents', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('kepegawaian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('penempatan')->nullable(); // Poli
            $table->string('fasyankes')->nullable();
            $table->string('alamat_nakes')->nullable();
            
            $table->string('alamat_fasyankes')->nullable();
            $table->string('jenis_fasyankes')->nullable();
            $table->unsignedBigInteger('file_nakes_id');
            $table->foreign('file_nakes_id')
                ->references('id')
                ->on('file_nakes');
            $table->string('status')->default('uploaded');
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
        Schema::connection('file_db')->dropIfExists('file_nakes_contents');
    }
};
