<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('name');
            $table->string('luas')->nullable();
            $table->string('lurah')->nullable();
            $table->text('alamat_lurah')->nullable();
            $table->string('nip')->nullable();
            $table->string('telp_lurah')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kecamatan_id')
                ->references('id')
                ->on('kecamatans');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desas');
    }
};
