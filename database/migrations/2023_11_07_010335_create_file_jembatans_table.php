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
        Schema::connection('file_db')->create('file_jembatans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_location');
            $table->string('status')->default('upload');
            $table->string('tanggal_data');
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
        Schema::connection('file_db')->dropIfExists('file_jembatans');
    }
};
