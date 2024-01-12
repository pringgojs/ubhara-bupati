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
        Schema::create('infrastruktur_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_ruas');
            $table->text('deskripsi')->nullable();
            $table->string('status_dipakai')->nullable(); // Terhubung dengan Table Status Jalan
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
        Schema::dropIfExists('infrastruktur_jalans');
    }
};
