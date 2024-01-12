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
        Schema::table('lahan_pertanians', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('komoditas_lahan_id')->nullable();
            $table->foreign('komoditas_lahan_id')
                ->references('id')
                ->on('komoditas_lahans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lahan_pertanians', function (Blueprint $table) {
            //
            $table->dropForeign('lahan_pertanians_komoditas_lahan_id_foreign');
            $table->dropColumn('komoditas_lahan_id');
        });
    }
};
