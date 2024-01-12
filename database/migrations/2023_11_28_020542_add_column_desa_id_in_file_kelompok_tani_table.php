<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
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
        Schema::connection('file_db')->table('file_kelompok_tani', function (Blueprint $table) {
            $db = DB::connection('mysql')->getDatabaseName();

            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')
                ->references('id')
                ->on(new Expression($db . '.desas'));
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('file_db')->table('file_kelompok_tani', function (Blueprint $table) {
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });
    }
};
