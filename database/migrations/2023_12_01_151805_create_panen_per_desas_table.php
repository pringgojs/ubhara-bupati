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
        Schema::create('panen_per_desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')
                ->references('id')
                ->on('desas');
            $table->unsignedBigInteger('komoditas_lahan_id')
                ->references('id')
                ->on('komoditas_lahans');
            $table->float('berat_panen'); // dalam ton
            $table->integer('nilai_panen'); // dalam Rupiah
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
        Schema::dropIfExists('panen_per_desas');
    }
};
